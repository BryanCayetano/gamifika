<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class studentController extends Controller
{
    public function insert_student(Request $request)
    {
        $request->validate([
            'nick' => 'required | unique:student',
            'email' => 'required | email | unique:student',
            'password' => 'required | confirmed',
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required'
        ]);

        $student = new student();
        $student->nick = $request->nick;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->birthdate = $request->birthdate;
        $student->save();

        return response()->json([
            "status" => 1,
            "msg" => "Registro de estudiante exitoso",
        ]);
    }

    public function login_student(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $student = student::where("email", "=", $request->email)->first();
        if (isset($student->id)) {
            if (Hash::check($request->password, $student->password)) {
                //creamos el token
                $token = $student->createToken("auth_token")->plainTextToken;
                //si está todo ok
                return response()->json([
                    "status" => 1,
                    "msg" => "¡Usuario logueado exitosamente!",
                    "access_token" => $token
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "La password es incorrecta",
                ], 404);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Usuario no registrado",
            ], 404);
        }
    }
}
