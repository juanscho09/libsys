<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;

class AuthController extends BaseController
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        try{
            $user = $this->authRepository->loginUser($request);
            if( !$user ) return $this->errorResponse("Unauthorized", 401);
        } catch(\Exception $ex) {
            return $this->errorResponse("Error al autenticarse".$ex->getMessage(), 500);
        }

        return $this->successResponse($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse("Se cerró la sesión.");
    }


    

    /*public function createToken($email){
        $isToken = DB::table('password_resets')->where('email', $email)->first();

        if($isToken) {
            return $isToken->token;
        }

        $token = Str::random(80);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email){
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }*/
}
