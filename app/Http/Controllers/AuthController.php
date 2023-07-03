<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $req)
    {

        $validator=Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,
                'messsage'=>$validator->errors()
            ];
            return response()->json($response,400);
        }
        $input=$req->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $success['token']=$user->createToken('MyApp')->plainTextToken;
        $success['name']=$user->name;
        $response=[
            'success'=>true,
            'data'=>$success,
            'message'=>'User Register Successful'
        ];
        return response()->json($response,200);
        
    }

    public function login(Request $req){
   if( Auth::attempt(['email'=>$req->email,'password'=>$req->password]) ){

        $user=Auth::user();
        $success['token']=$user->createToken('MyApp')->plainTextToken;
        $success['name']=$user->name;
        $response=[
            'success'=>true,
            'data'=>$success,
            'message'=>'User Login Successful'
        ];
        return response()->json($response,200);
        
    }else{
        $response=[
            'success'=>false,
              'message'=>'Unauthorized'      
        ];
        return response()->json($response);
    }
}
}
