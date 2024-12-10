<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ActivacionCuenta;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //(admin) Mostrar todos los usuarios desactivados
    public function index()
    {
        $users = User::where('deleted', 0)
            ->where('rol', '!=', 'a')
            ->get();

        return view('admin.users', compact('users'));
    }

    // (admin) Activar usuario (correo)
    public function activate($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_confirmed != 1) {
            return redirect()->back()->with('error', 'El usuario no ha confirmado su correo electrónico.');
        }

        $user->actived = 1;
        $user->save();

        // Enviar correo de activación
        Mail::to($user->email)->send(new ActivacionCuenta($user));

        return redirect()->back()->with('success', 'Usuario activado y notificado.');
    }

    // (admin) desactivar usuario
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->actived = 0;
        $user->save();
        return redirect()->back()->with('success', 'Usuario desactivado.');
    }

    // (admin) eliminar usuario
    public function destroy(User $user)
    {
        $user->deleted = 1;
        $user->save();
        return redirect()->back()->with('success', 'Usuario eliminado.');
    }

    //(admin) redirigis a la vista update
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Redirigir a la vista para actualizar el usuario
        return view('auth.update', compact('user'));
    }

    // (admin) actualizar nombre del usuario seleccionado
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Nombre actualizado exitosamente.');
    }

    
    //retorna la vista de un usuario normal
    public function dashboard()
{
    $userId = auth()->id();
    return view('user.normalUser', compact('userId'));
}

}