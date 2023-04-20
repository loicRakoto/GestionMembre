<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{

    public function index()
    {
        return view('/layout/login');
    }

    public function authenticate(Request $request)
    {
        // $valid = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);


        $validation = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'password.required' => 'Le champ mot de passe est requis.',
        ]);


        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'messageError' => $validation->errors()->all()
            ]);
        } else {

            if (Auth()->attempt($request->only('email', 'password'))) {
                // $request->session()->regenerate();

                // return redirect()->route('membre.index');

                return response()->json([
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 0
                ]);
            }
        }


        // return back()->withErrors("L'utilisateur ou le mots de passes ne corresponde pas");
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
