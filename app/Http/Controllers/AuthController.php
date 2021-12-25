<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $rules= [
                        'name'=>"required",
                        'email'=>"required|email",
                        'access-token'=>"required"
                ];
            $validator=Validator::make($request->all(),$rules);
            if ($validator->fails())
            {
                return response()->json([
                    'stat'=>200,
                    'msg'=>$validator->errors()->first(),
                ],200);

            }
            $credintial=$request->only('name','email','access-token');
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'access-token'=>$request->access-token,
            ]);


        }
        catch (Exception $exception)
        {

        }


    }
    public function getFormData()
    {

    }
    public function createUser()
    {

    }
}
