<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //REGISTER API
    public function register(Request $request) // REQUEST INSTANCE
    {
        //validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:students",
            "password" => "required|confirmed"
        ]);

        //create data
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->phone_no = isset($request->phone_no) ? $request->phone_no : "";

        $student->save();


        //send response

        return response()->json([
            "status" => 1,
            "message" => "Student registered successfully"
        ]);
    }

    //LOGIN API
    public function login(Request $request) // REQUEST INSTANCE
    {
        //validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        //check student 
        $student=Student::where("email", "=", $request->email)->first();
        //create a token 

        //send response

    }

    //PROFILE API
    public function profile()
    {
    }

    //LOGOUT API
    public function logout()
    {
    }
}
