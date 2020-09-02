<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Role;

class UserController extends Controller
{
    public function getAll(){
        $user=User::all();
        return response()->json($user->toArray(),200);
    }
    public function login(Request $request){
        try{
            $user=User::where('email',$request['email'])->first();
            if($user==null){
                return response()->json('Correo No Registrado',500);
            }
            $credentials = request(['email', 'password']);
        
            if (!Auth::attempt($credentials)) {
                return response()->json('Contraseña Incorrecta', 500);
            }
            $role=Role::find($user->rol_id);
            $tokenResult = $user->createToken('Personal Access Token');
            $token=$tokenResult->token;
            $token->save();
            return response()->json([
                'role_id'      => $user->rol_id,
                'role_name'    => $role->name,
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => 'Session closed'
            ],200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
