<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teacher;
use Illuminate\Support\Facades\Hash;

class teacherController extends Controller
{
    public function insert_teacher(Request $request)
    {
        $request->validate([
            'nick' => 'required | unique:teacher',
            'email' => 'required | email | unique:teacher',
            'password' => 'required | confirmed',
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required'
        ]);

        $teacher = new teacher();
        $teacher->nick = $request->nick;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->name = $request->name;
        $teacher->surname = $request->surname;
        $teacher->study_center = $request->study_center;
        $teacher->save();

        return response()->json([
            "status" => 1,
            "msg" => "Registro de estudiante exitoso",
        ]);
    }

    public function login_teacher(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $profesor = teacher::where("email", "=", $request->email)->first();
        if (isset($profesor->id)) {
            if (Hash::check($request->password, $profesor->password)) {
                //creamos el token
                $token = $profesor->createToken("auth_token")->plainTextToken;
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
    public function logout_teacher(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "status" => 1,
            "msg" => "Cierre de Sesión",
        ]);   
    }
}
