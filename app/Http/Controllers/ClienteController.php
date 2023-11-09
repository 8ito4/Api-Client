<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClienteValidator; 

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function criarNovoCliente(ClienteValidator $request): JsonResponse
    {
        try {
            $data = $request->validated(); 

            $cliente = $this->clienteService->criarNovoCliente($data);
            return response()->json($cliente, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao criar o cliente'], 500);
        }
    }

    public function buscarClientePorID(int $id): JsonResponse
    {
        $cliente = $this->clienteService->buscarClientePorID($id);

        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }

    public function editarCliente(ClienteValidator $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated(); 

            $cliente = $this->clienteService->editarCliente($id, $data);

            if ($cliente) {
                return response()->json($cliente);
            } else {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao editar o cliente'], 500);
        }
    }

    public function excluirCliente(int $id): JsonResponse
    {
        try {
            $this->clienteService->excluirCliente($id);
            return response()->json(['message' => 'Cliente excluído'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir o cliente'], 500);
        }
    }
}
