<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'regex:/^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', 'date'],
            'country' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
        ]);

        if (Carbon::parse($data['birth_date'])->gt(now()->subYears(9))) {
            throw ValidationException::withMessages([
                'birth_date' => ['Debes tener al menos 9 años para registrarte.'],
            ]);
        }

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
            'country' => $data['country'],
            'city' => $data['city'],
        ]);

        $user->assignRole('cliente');

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                ...$user->only(['id', 'name', 'last_name', 'email', 'birth_date', 'country', 'city']),
                'roles' => $user->getRoleNames()->values(),
            ],
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($request->only('email','password'))) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas']
            ]);
        }

        $user = $request->user();

        // borrar tokens antiguos
        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                ...$user->only(['id', 'name', 'last_name', 'email', 'birth_date', 'country', 'city']),
                'roles' => $user->getRoleNames()->values(),
            ],
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                ...$user->only(['id', 'name', 'last_name', 'email', 'birth_date', 'country', 'city']),
                'roles' => $user->getRoleNames()->values(),
            ],
        ]);
    }

    public function updateMe(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['sometimes', 'required', 'date'],
            'country' => ['sometimes', 'required', 'string', 'max:120'],
            'city' => ['sometimes', 'required', 'string', 'max:120'],
        ]);

        if (array_key_exists('password', $data) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'user' => [
                ...$user->fresh()->only(['id', 'name', 'last_name', 'email', 'birth_date', 'country', 'city']),
                'roles' => $user->getRoleNames()->values(),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout correcto'
        ]);
    }
}
