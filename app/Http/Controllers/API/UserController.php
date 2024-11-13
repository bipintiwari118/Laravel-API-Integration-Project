<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


        if($validator->fails()){
            return response()->json($validator->errors());

        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);



         return response()->json([
            'msg'=>'User Inserted successfully',
            'user'=>$user
         ]);


    }


    public function login(Request $request){
       $validator = validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());

        }

        if(!$token=Auth::attempt($validator->validated())){
            return response()->json([
                'success'=>false,
                'msg'=>'Username and Password does not match, try agian.',
            ]);

        }
      return  $this->respondWithToken($token);


    }

    protected function respondWithToken($token){
        return response()->json([
            'success'=>true,
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
        ]);


    }

    public function logout(){

        try{
            Auth::logout();
            return response()->json([
                'success'=>true,
                'msg'=>'User logout successfully.'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'msg'=>$e->getMessage()
            ]);
        }

    }

    public function profile(){
        try{
            return response()->json(['success'=>true,'data'=>auth()->user()]);
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'msg'=>$e->getMessage()
            ]);
        }
    }


}
