<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'c_password'=> 'required|same:password',
            

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        // $success['token'] = $user->createToken('AnasEidDalal')->plainTextToken;
        $userData=User::where('email',$request->email)->first();


        $response=[
            'user'=>$userData,
            'token'=>$user->createToken('AnasEidDalal')->plainTextToken,
        ];
        return $this->sendResponse($response, 'User registered Successfully!' );
    }


    public function login(Request $requset)
    {
        $user=User::where('email',$requset->email)->first();
     
        if(!$user || !Hash::check($requset->password,$user->password))
        {
            return response([
                'message'=>['these credentials do not match our records.']
            ],404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];

    
        return $this->sendResponse($response, 'User login Successfully!' );


    

    }


    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];
    }






}
