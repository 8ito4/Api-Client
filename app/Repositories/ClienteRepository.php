<?php

namespace App\Repositories;

use App\Models\Cliente;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ClienteRepository
{
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $cliente = new Cliente();
            $cliente->nome = $data["nome"];
            $cliente->email = $data["email"];
            $cliente->save();
            DB::commit();
            return $cliente;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function find(int $id)
    {
        return Cliente::find($id);
    }

    public function update(int $id, array $data)
    {
        try {
            DB::beginTransaction();
            $cliente = Cliente::findOrFail($id);
            $cliente->nome = $data["nome"];
            $cliente->email = $data["email"];
            $cliente->save();
            DB::commit();
            return $cliente;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function delete(int $id)
    {
        try {
            DB::beginTransaction();
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
