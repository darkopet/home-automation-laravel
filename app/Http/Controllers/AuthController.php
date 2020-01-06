<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Libs\Rules;

class AuthController extends Controller
{
    private $rules;

    function __construct()
    {
        $this->rules = new Rules();   
    }

    public function register(Request $r) {
        $r->validate($this->rules->userRegisterRule());

        $user = User::create([
            'email' => $r->email,
            'password' => $r->password
        ]);

        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $r) {
        $credentials = $r->only(['email', 'password']);

        if( !$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized']);
        }

        return $this->respondWithToken($token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user(Request $r) {
        return $r->user();
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiries_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
