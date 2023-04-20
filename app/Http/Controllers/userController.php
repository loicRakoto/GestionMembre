<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validation = Validator::make(request()->all(), [
            'emailInscr' => 'required|email',
            'passwordInscr' => 'required',
            'pseudoInscr' => 'required',
            'confirmpasswordInscr' => 'required|same:passwordInscr',
        ], [
            'emailInscr.required' => 'Le champ email est requis.',
            'emailInscr.email' => 'Le champ email doit être une adresse email valide.',
            'passwordInscr.required' => 'Le champ mot de passe est requis.',
            'pseudoInscr.required' => 'Le champ pseudo est requis.',
            'confirmpasswordInscr.required' => 'Le champ confirmation du mot de passe est requis.',
            'confirmpasswordInscr.same' => 'Les champs mot de passe et confirmation du mot de passe doivent être identiques.',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'messageError' => $validation->errors()->all()
            ]);
        } else {

            $now = Carbon::now();
            $formattedDate = $now->format('Y-m-d H:i:s');
            $mdp = Hash::make($request->confirmpasswordInscr);
            $rememberToken = Str::random(60);
            $users = new User();
            $users->name = $request->pseudoInscr;
            $users->email = $request->emailInscr;
            $users->email_verified_at = $formattedDate;
            $users->password = $mdp;
            $users->remember_token = $rememberToken;
            $users->save();
            return response()->json([
                'status' => 200
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
