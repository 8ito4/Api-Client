<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService
{
    protected $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function criarNovoCliente(array $data)
    {
        return $this->clienteRepository->create($data);
    }

    public function buscarClientePorID(int $id)
    {
        return $this->clienteRepository->find($id);
    }

    public function editarCliente(int $id, array $data)
    {
        return $this->clienteRepository->update($id, $data);
    }

    public function excluirCliente(int $id)
    {
        $this->clienteRepository->delete($id);
    }
}



