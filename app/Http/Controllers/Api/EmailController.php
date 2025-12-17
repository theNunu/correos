<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\MensajeMail;
use Illuminate\Support\Facades\Mail;
class EmailController extends Controller
{
    public function enviar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'mensaje' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Mail::to($request->email)->send(
            new MensajeMail($request->mensaje)
        );

        return response()->json([
            'message' => 'Correo enviado correctamente'
        ]);
    }
}
