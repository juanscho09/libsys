<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthRepository extends BaseRepository
{
    const RELATIONS = [];

    public function __construct(User $model)
    {
        parent::__construct($model, self::RELATIONS);
    }

    public function loginUser(Request $request){

        if( !auth()->attempt($request->only('email', 'password')) ){
            return false;
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        /*$request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'user_type_id' => 'required'
        ]);*/


        return [
            'user' => $user,
            'token_type' => "Bearer",
            'access_token' => $token
        ];
    }
}