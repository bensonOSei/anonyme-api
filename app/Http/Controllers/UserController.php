<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Craete user
    public function create(Request $request)
    {
        $fields = $request->validate([
            'nickname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // return $fields;

        $user = User::create([
            'nickname' => $fields['nickname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('anonymeToken')->plainTextToken;

        return response([
            'user' => $this->returnUsableUserData($user),
            'token' => $token,
        ]);
    }

    // User login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('anonymeToken')->plainTextToken;

        return response([
            'user' => $this->returnUsableUserData($user),
            'token' => $token
        ]);
    }

    private function returnUsableUserData(User $user): array
    {
        return [
            'id' => $user->id,
            'nickname' => $user->nickname,
            'email' => $user->email,
        ];
    }
}
