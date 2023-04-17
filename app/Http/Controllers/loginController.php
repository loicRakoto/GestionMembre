<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function index()
    {
        return view('/layout/login');
    }

    public function authenticate(Request $request)
    {
        $valid = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth()->attempt($request->only('email', 'password'))) {
            // $request->session()->regenerate();

            return redirect()->route('membre.index');
        }

        return back()->withErrors("L'utilisateur ou mots de passes ne corresponde pas");
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function testAjout()
    {
        $users = new User();
        $users->name = "stark";
    }
}
