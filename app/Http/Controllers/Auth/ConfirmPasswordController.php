<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;

class ConfirmPasswordController extends Controller
{

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/tasks';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware que asegura que solo los usuarios autenticados pueden acceder
    }

    /**
     * Get the failed password confirmation response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedPasswordConfirmationResponse(Request $request)
    {
        return back()->withErrors([
            'password' => 'La contraseña proporcionada no es válida.',
        ]);
    }

    /**
     * Get the response for a successful password confirmation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendSuccessfulPasswordConfirmationResponse(Request $request)
    {
        return redirect()->intended($this->redirectPath())
                        ->with('status', '¡Contraseña confirmada correctamente!');
    }
}
