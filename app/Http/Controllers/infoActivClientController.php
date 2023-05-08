<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Membre;
use App\Models\Participer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class infoActivClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idActivite)
    {
        $participer = Participer::with('membress')->where('activite_id', $idActivite)->get();

        $activite = Activite::all()->find($idActivite);
        return view('/ACTIVITES/infoActivClient', compact('participer', 'activite'));
    }

    public function modifActivite(Request $req)
    {
        $reste = $req->reste;
        $idParticiper = $req->identParticiper;
        $statusPayement = $req->radioPayement;
        $participant = Participer::all()->find($idParticiper);
        $idActivite = $participant->activite_id;



        if ($statusPayement == "payer") {
            $participant->Status_payement = 'PAYER';
            $participant->Reste = 0;
            $participant->update();
        } elseif ($statusPayement == "non_payer") {
            $participant->Status_payement = 'NON PAYER';
            $participant->Reste = 0;
            $participant->update();
        } else {
            $participant->Status_payement = 'ENGAGER';
            $participant->Reste = $reste;
            $participant->update();
        }


        return response()->redirectToRoute('infoActivite.index', $idActivite);
    }

    public function affichageBarPayement(Request $request, Response $response)
    {
        $id_activite = $request->activiteId;
        $membreId = $request->membreId;

        $membrefind = Membre::all()->find($membreId);


        $participer = Participer::with('membress')->where('activite_id', $id_activite)->get();
        $information = $participer->where('membre_id', $membreId)->first();



        return response()->json([
            "membreInfo" => $membrefind,
            "infoPayement" => $information

        ]);
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
