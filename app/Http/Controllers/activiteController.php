<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Membre;
use App\Models\Participer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activiteList = Activite::all();


        //Recuperation des participants
        $paticipant = DB::table('participers')->where('activite_id', 1)->count('*');

        //Recupereration de la liste des membres ayant payer
        $NbrPaye = DB::table('participers')->where('activite_id', 1)->where('Status_payement', 'PAYER')->count('*');

        //Recuperation de la liste des membres n'ayant pas encore payer
        $NbrNonPaye = DB::table('participers')->where('activite_id', 1)->where('Status_payement', 'NON PAYER')->count('*');


        return view('/ACTIVITES/listActivite', compact('activiteList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // $token = csrf_token();

        $request->validate([
            'Nom' => 'required',
            'Description' => 'required',
            'Debut' => 'required',
            'Fin' => 'required',
            'Lieux' => 'required',
            'Responsable' => 'required',
            'Cout' => 'required'
        ]);

        $activite = new Activite();
        $activite->Nom_activite = $request->Nom;
        $activite->Description = $request->Description;
        $activite->Date_debut = $request->Debut;
        $activite->Date_fin = $request->Fin;
        $activite->Lieux = $request->Lieux;
        $activite->Responsable = $request->Responsable;
        $activite->Cout = $request->Cout;
        $activite->save();

        //Recuperation de la dernière activité
        $lastID = DB::table('activites')->max('id');


        //Recuperation de tous les membres

        $membres = Membre::all();

        foreach ($membres as $key) {
            $participation = new Participer();
            $participation->activite_id = $lastID;
            $participation->membre_id = $key->id;
            $participation->Status_payement = 'NON PAYER';
            $participation->Reste = 0;
            $participation->save();
        }

        return response()->redirectToRoute('activite.index');
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
