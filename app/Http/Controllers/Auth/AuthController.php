<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
    if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['mensaje' => 'inicio de sesion invalido'], 401);
        }

    $user = Auth::user();
    $token = $user->createToken('token')->plainTextToken;

    $response = [
        'id' => $user->id,
        'nombre' => $user->nombre,
        'email' => $user->email,
        'api_token' => $token,
        'rol' => $user->rol
    ];

    return response()->json($response, 200);
    }

    public function logout(Request $request) {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();
            return response()->json(["mensaje" => "cierre de sesion correcto"], 200);
        } catch (\Exception $e) {
            return response()->json(["mensaje" => "informacion no procesada"], 422);
        }
    }

    
    
}
