<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request): JsonResponse
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('app-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    return response()->json(['message' => 'E-mail ou senha inválida'], 401);
}

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json(['user' => $user]);
    }
}
