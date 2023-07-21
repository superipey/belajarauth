<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user) || !Hash::check($request->password, @$user->password)) return response()->error('Invalid auth.', 401);

        $token = md5($user->email);

        $user->token()->updateOrCreate(
            [
                'id_user' => $user->id
            ],
            [
                'token' => $token
            ]
        );

        return response()->success(['token' => $token]);
    }

    public function me(Request $request)
    {
        return response()->success($request->user);
    }
}
