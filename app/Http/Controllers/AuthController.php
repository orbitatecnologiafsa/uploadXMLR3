<?php

namespace App\Http\Controllers;

use App\Models\ClienteApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $guardUser;
    protected $apicliente;

    public function __construct()
    {
        $this->middleware('clientes_api', ['except' => ['login']]);
        $this->guardUser = 'clientes_api';
        $this->apicliente = new ClienteApi();
    }
    protected function respondWithToken($token)
    {
        //$2y$10$rOb29KUXLdLATwFs9mpgGub7l84ZvmcwKbC.7A7/qxvnWUDrmRYrG -> bf174163e8121628bdde460d40bd79bb ->md5('orbita-securyt-2023')
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guardUser)->factory()->getTTL() * 20160
        ]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            [
                'email' =>  base64_decode($request->input('email')),
                "password" => $request->input('password')
            ],
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        if ($validator->fails()) return response()->json(['msg' => $validator->errors()], 400);
        $credencial = $validator->validate();
        if (!$token = auth($this->guardUser)->attempt($credencial)) {
            return response()->json(['msg' => 'Invalid credentials'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        auth($this->guardUser)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth($this->guardUser)->refresh());
    }

    public function user()
    {
        return response()->json(auth($this->guardUser)->user());
    }
}
