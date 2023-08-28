<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
{
    if (Auth::check()) {
        // Révoquer le jeton d'accès de l'utilisateur authentifié
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    return response()->json([
        'message' => 'User not logged in'
    ], 401);
}




    public function me(Request $request)
    {
        return $request->user();
    }
    public function index()
    {
        // Récupérer la liste de tous les utilisateurs, en excluant l'utilisateur avec ID 1
        $users = User::where('id', '<>', 1)->get();

        return response()->json($users);
    }


    public function show($id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Vérifier si l'utilisateur authentifié est autorisé à voir cet utilisateur
        if ($user->id === 1) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // Vérifier si l'utilisateur authentifié a le droit de voir cet utilisateur
        if (Auth::user() && Auth::user()->id === $user->id) {
            return response()->json($user);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

    }
}
