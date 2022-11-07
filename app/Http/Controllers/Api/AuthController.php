<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Models\User; 

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;


class AuthController extends Controller
{
    /**
     * Crear usuario
     * @param Request $request
     * @return User 
     */
    public function createUser(CreateUserRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Usuario creado correctamente',
                'token' => $user->createToken("auth_token")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Inicio sesion (obtener token)
     * @param Request $request
     * @return User
     */
    public function loginUser(LoginUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
           
            if(!Auth::attempt($validatedData)){
                return response()->json([
                    'status' => false,
                    'message' => 'Credenciales invalidas',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Inicio de sesion correcto',
                'token' => $user->createToken("auth_token")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
