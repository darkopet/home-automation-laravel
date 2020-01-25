<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Libs\Rules;

class AuthController extends Controller
{
    private $rules;

    function __construct() {
        $this->rules = new Rules();
    }

    public function register(Request $r) {
        $r->validate($this->rules->userCredentialsRule());

        $user = User::create([
            'email' => $r->email,
            'password' => $r->password
        ]);

        $token = auth()->login($user);
        $this->respondWithToken($token);
    }

    public function login(Request $r) {
        $r->validate($this->rules->userCredentialsRule());
        
        $credentials = $r->only(['email', 'password']);

        if( !$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized']);
        }

        $this->respondWithToken($token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['status' => 'success'], 200);
    }

    public function user(Request $r) {
        return response()->json(['status' => 'success', $r->user()], 200);
    }

    public function refreshToken() {
        return False;
    }

    protected function respondWithToken($token) {
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiries_in' => auth()->factory()->getTTL() * 60
        ], 200)->header('Authorization', $token);
    }
}
