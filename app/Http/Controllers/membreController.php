<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;

class membreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/MEMBRES/listMembre');
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

    public function fetchdata()
    {
        $membre = Membre::all()->toJson();
        return $membre;
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
            'nom' => 'required',
            'prenom' => 'required',
            'filliere' => 'required',
            'adresse' => 'required',
            'promotion' => 'required',
        ]);

        $pathe = null;
        $fileName = null;

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'messageError' => $validation->errors()->all()
            ]);
        } else {

            // Veriification de l'image 
            if (!$request->hasFile('image')) {

                $pathe = '';
            } else {

                $fileName = $request->file('image')->getClientOriginalName();
            }

            if (Storage::disk('public')->exists($fileName)) {
                $pathe = $request->file('image')->storeAs('images', $fileName, 'public');
            } else {
                // Le fichier n'existe pas
                if (!$request->hasFile('image')) {
                    $pathe = '';
                } else {
                    $pathe = $request->file('image')->storeAs('images', $fileName, 'public');
                }
            }

            // dd($pathe);

            $nom = $request->nom;
            $prenom = $request->prenom;
            $filliere = $request->filliere;
            $adresse = $request->adresse;
            $promotion = $request->promotion;


            $membre = new Membre();
            $membre->Nom = $nom;
            $membre->Prenom = $prenom;
            $membre->Filliere = $filliere;
            $membre->Adresse = $adresse;
            $membre->Promotion = $promotion;
            $membre->imageMembre = $pathe;
            $membre->save();



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
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->recup;
        $membre = Membre::find($id);
        return $membre;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $numero = $request->id;
        $numero = strtolower(trim($numero));
        $resultats = DB::table('membres')
            ->where('id', 'like', '%' . $numero . '%')
            ->orWhere('Nom', 'like', '%' . $numero . '%')
            ->orWhere('Prenom', 'like', '%' . $numero . '%')
            ->orWhere('Filliere', 'like', '%' . $numero . '%')
            ->orWhere('Adresse', 'like', '%' . $numero . '%')
            ->orWhere('Promotion', 'like', '%' . $numero . '%')
            ->get();
        return response()->json($resultats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validation = Validator::make(request()->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'filliere' => 'required',
            'adresse' => 'required',
            'promotion' => 'required',
        ]);


        $pathe = null;
        $fileName = null;
        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'messageError' => $validation->errors()->all()
            ]);
        } else {

            // Veriification de l'image 
            if (!$request->hasFile('image')) {
                $pathe = '';
            } else {
                $fileName = $request->file('image')->getClientOriginalName();
            }

            if (Storage::disk('public')->exists($fileName)) {
                $pathe = $request->file('image')->storeAs('images', $fileName, 'public');
            } else {
                // Le fichier n'existe pas
                if (!$request->hasFile('image')) {
                    $pathe = '';
                } else {

                    $pathe = $request->file('image')->storeAs('images', $fileName, 'public');
                }
            }


            $id = $request->idmember;
            $nom = $request->nom;
            $prenom = $request->prenom;
            $filliere = $request->filliere;
            $adresse = $request->adresse;
            $promotion = $request->promotion;

            $exist = Membre::find($id);


            $exist->Nom = $nom;
            $exist->Prenom = $prenom;
            $exist->Filliere = $filliere;
            $exist->Adresse = $adresse;
            $exist->Promotion = $promotion;
            $exist->imageMembre = $pathe;
            $exist->update();

            return response()->json([
                'status' => 200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $membre = Membre::find($id);

        $membre->delete();

        return response(true);
    }
}
