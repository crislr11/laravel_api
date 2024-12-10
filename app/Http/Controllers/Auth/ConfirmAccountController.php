<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ConfirmAccountController extends Controller
{
    public function confirmarCuenta($token)
    {
        // Buscar el usuario directamente por el remember_token
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token de confirmación inválido.');
        }

        // Actualizar los campos de verificación de correo
        $user->email_verified_at = now();
        $user->email_confirmed = 1;
        $user->remember_token = null; // Opcional: eliminar el token de confirmación
        $user->save();

        return redirect()->route('login')->with('status', 'Correo confirmado exitosamente. Esperando la activación por parte del administrador.');
    }
}
