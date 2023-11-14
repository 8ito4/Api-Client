<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request): JsonResponse
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            $usuario = Auth::user();
            $token = $usuario->createToken('app-token')->plainTextToken;

            return $this->respostaSucesso(['token' => $token, 'usuario' => $usuario]);
        }

        return $this->respostaErro('Credenciais inválidas', 401);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->respostaSucesso(['mensagem' => 'Logout realizado com sucesso']);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $usuario->createToken('app-token')->plainTextToken;

        return $this->respostaSucesso(['token' => $token, 'usuario' => $usuario]);
    }

    protected function respostaSucesso($dados): JsonResponse
    {
        return response()->json($dados);
    }

    protected function respostaErro($mensagem, $statusCode): JsonResponse
    {
        return response()->json(['mensagem' => $mensagem], $statusCode);
    }
}
