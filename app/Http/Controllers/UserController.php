<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateUser;
use Exception;
use App\Role;
use App\Employee;
use Carbon\Carbon;

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
            if(!$user->password_creada){
                return response()->json('No se creo una contraseña',500);
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
    public function new(Request $request){
        try{
            $employee=new Employee();
            $employee->ci=$request['ci'];
            $employee->nombre=$request['nombre'];
            $employee->apellido=$request['apellido'];
            $employee->sexo=$request['sexo'];
            $employee->rol_id=$request['rol_id'];
            $employee->departament_id=$request['departament_id'];
            $employee->created_at=Carbon::now();
            $employee->save();

            $user=new User();
            $user->email=$request['email'];
            $user->password=$request=bcrypt(env('SECRET_PASSWORD'));
            $user->password_creada=false;
            $user->employee_id=$employee->id;
            $user->rol_id=$employee->rol_id;
            $user->created_at=Carbon::now();
            try{
                $user->save();
            }catch(Exception $ex){
                Employee::find($employee->id)->delete();
                throw $ex;
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            $role=Role::find($user->rol_id);
                $correo=[
                    'person'=>$employee,
                    'username'=>$user->email,
                    'role'=>$role,
                    'token'=>$tokenResult->accessToken
                ];
            Mail::to($user->email)->send(new CreateUser($correo));
            return $correo;
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function createPassword(Request $request){
        try{
            $user=$request->user();
            if ($user->password_creada){
                return response()->json('La contraseña ya fue creada',500);
            } 
            $user->password=bcrypt($request['password']);
            $user->password_creada=true;
            $user->save();
            return response()->json('Contraseña actualizada',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
