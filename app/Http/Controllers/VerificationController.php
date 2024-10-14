<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    
    
    function loadProfile(){
        
    }
    
    private $status_code    =        200;

    public function registration(Request $request) {
       
        $val = Validator::make($request->all(),[

            "name" => "required|max:200",
            "email" => "required|max:200|email",
            "password"=>"required|max:100|min:8",
            "phone"  =>  "required|max:11|min:11"
        ]);

        if($val->fails()) {
            return response()->json([
                "status" => "failed",
                
                  "val_errors" => $val->errors()]);
        }

     

        $userArray= array(
          
            "name" =>$request->name,
            "email" =>$request->email,
            "password"=>md5($request->password),
            "phone"=> $request->phone
        );

        $checkEmail   =  User::where("email", $request->email)->first();
        
        

        if(!($checkEmail=== NULL)) {
           return response()->json(["status" => "failed", "success" => false, 
                                "message" => "Whoops! email already registered"]);
        }

        $NewUser   =  User::create($userArray);

        if(!($NewUser===NULL)) {
            return response()->json(["status" => $this->status_code, 
            "success" => true,
             "message" => "Registration completed successfully",
              "data" => $NewUser]);
        }

        else {
            return response()->json([
                "status" => "failed", 
                "success" => false, 
                "message" => "failed to register"]);
        }
    }



    public function fetchuser($email) {
      
        if(!($email === NULL)) {
            $user   =   User::where("email", $email)->first();
            return $user;
        }
    }
    
    public function login(Request $request) {

        $val   =  Validator::make($request->all(),[
                "email" => "required|max:200|email",
            
                "password"=>"required|max:100|min:8",
            ]
        );

        if($val->fails()) {
            return response()->json([
                "status" => "failed", 
                "validation_error" => $val->errors()]);
        }


        $checkEmail = User::where("email", $request->email)->first();


        if(!($checkEmail=== NULL)) {
            $checkPassword  = User::where("email", $request->email)->where("password", md5($request->password))->first();


            if(!($checkPassword===NULL)) {
                $user    =   $this->fetchuser($request->email);

                return response()->json([
                    "status" => $this->status_code, 
                    "success" => true,
                     "message" => "You have logged in successfully", 
                     "data" => $user]);
            }

            else {
                return response()->json([
                    "status" => "failed", 
                    "success" => false,
                     "message" => "Unable to login. Incorrect password."]);
            }
        }

        else {
            return response()->json([
                "status" => "failed",
             "success" => false,
              "message" => "Unable to login. Email doesn't exist."]);
        }
    }

 
   
}
