<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login() {
        return view('Users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            if (!auth()->user()->confirmed) {
                auth()->logout();
        
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors(['email' => 'Votre compte n\'est pas encore vérifié. Contactez votre adiministrateur pour plus d\'informations.'])->onlyInput('email');
            }
            return redirect('/')->with('message', 'Vous êtes connecté(e)s!');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe invalide'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous êtes déconnecté(e)s!');
    }
}
