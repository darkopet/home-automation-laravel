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
        return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
    }

    public function login(Request $r) {
        $r->validate($this->rules->userCredentialsRule());
        
        $credentials = $r->only(['email', 'password']);

        if( !$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized']);
        }

        return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['status' => 'success']);
    }

    public function user(Request $r) {
        return $r->user();
    }

    public function refreshToken() {
        return False;
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiries_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
