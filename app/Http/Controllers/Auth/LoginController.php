<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Verificar si el usuario está activado
        if (Auth::user()->actived == 0) {
            Auth::logout();
            return redirect()->back()->withErrors([
                'email' => 'Tu cuenta aún no ha sido activada.',
            ]);
        }

        // Si el usuario está activado, redirige al dashboard
        return redirect()->intended($this->redirectTo);
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas',
    ]);
}

public function logout(Request $request)
    {
        Auth::logout(); 

        return redirect()->route('login')->with('status', 'Has cerrado sesión correctamente.');
    }

}
