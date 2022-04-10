<?php

namespace App\Http\Controllers;

use App\Http\Resources\EleveurproprietairesCollection;
use App\Http\Resources\EleveurproprietairesResource;
use App\Http\Resources\EleveursnaisseursResource;
use App\Models\Eleveurproprietaire;
use Illuminate\Http\Request;

class EleveurproprietairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!empty($request->dateD && $request->dateF)) {

            if (!empty($request->dateD) && !empty($request->dateF)) {
                $dateDebut = date("Y-m-d H:i:s", strtotime($request->dateD . '00:00:00'));
                $DateFin = date("Y-m-d H:i:s", strtotime($request->dateF . '23:59:59'));
                $Eleveurproprietaires = Eleveurproprietaire::whereBetween('created_at', [$dateDebut, $DateFin])->withCount('sujets')->withTrashed()->latest()->get();
                return new EleveurproprietairesCollection($Eleveurproprietaires);
            }
        } else {
            $Eleveurproprietaires = Eleveurproprietaire::withCount('sujets')->withTrashed()->latest()->get();
            return new EleveurproprietairesCollection($Eleveurproprietaires);
        }
    }

    public function getCount()
    {
        $EleveurproprietaireCount = Eleveurproprietaire::distinct('Nom', 'Prenom')->count();
        return response()->json(['NbrEleveurproprietaire' => $EleveurproprietaireCount]);
    }
    public function Activate($id)
    {
        $Naisseur = Eleveurproprietaire::withTrashed()->findOrFail($id);
        $Naisseur->deleted_at = Null;
        $Naisseur->Etat = 'Active';
        $Naisseur->save();
        return response()->json(['Msg' => 'Proprietaire Deactive']);
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
        //
        $request->validate([
            'Nom' => 'nullable|Max:21',
            'Prenom' => 'nullable|Max:17',
            'Adresse' => 'nullable|Max:42',
            'CIN' => 'nullable'
        ]);
        $Expropr = Eleveurproprietaire::where('CIN', $request->CIN)->withTrashed()->first();
        if (!empty($Expropr)) {
            return response()->json([
                'Msg' => 'Proprietaire Exist ',
                'id' => $Expropr->id,
                'Propr' => $Expropr,
            ]);
        } else if (empty($Expropr) && $request->sreach !== true) {
            $Eleveurproprietaire = Eleveurproprietaire::create([
                'Nom' => $request->Nom,
                'Prenom' => $request->Prenom,
                'Adresse' => $request->Adresse,
                'Etat' => 'Active',
                'CIN' => $request->CIN,
                'user_id' => auth()->user()->id,
            ]);
            return new EleveurproprietairesResource($Eleveurproprietaire);
        } else {
            return response()->json([
                'message' => 'Prop Non Exists',
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
        $Eleveurproprietaire = Eleveurproprietaire::findOrFail($id);
        return new EleveurproprietairesResource($Eleveurproprietaire);
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
        $Eleveurproprietaire = Eleveurproprietaire::findOrFail($id);
        $request->validate([
            'Nom' => 'Max:21',
            'Prenom' => 'Max:17',
            'Adresse' => 'Max:42',
        ]);
        /*if($request->has('ID') && !empty($request->ID)){
            $Eleveurproprietaire->ID=$request->ID;
        }*/
        if ($request->has('Nom') && !empty($request->Nom)) {
            $Eleveurproprietaire->Nom = $request->Nom;
        }
        if ($request->has('Prenom') && !empty($request->Prenom)) {
            $Eleveurproprietaire->Prenom = $request->Prenom;
        }
        if ($request->has('Adresse') && !empty($request->Adresse)) {
            $Eleveurproprietaire->Adresse = $request->Adresse;
        }

        if ($request->has('user_id') && !empty($request->user_id)) {
            $Eleveurproprietaire->user_id = $request->user_id;
        }
        if ($request->has('CIN') && !empty($request->CIN)) {
            $Eleveurproprietaire->CIN = $request->CIN;
        }

        $Eleveurproprietaire->update([
            'Nom' => $Eleveurproprietaire->Nom,
            'Prenom' => $Eleveurproprietaire->Prenom,
            'Adresse' => $Eleveurproprietaire->Adresse,
            'user_id' => $Eleveurproprietaire->user_id,
            'CIN' => $Eleveurproprietaire->CIN,
        ]);
        return new EleveurproprietairesResource($Eleveurproprietaire);
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
        $Eleveurproprietaire = Eleveurproprietaire::findOrFail($id);
        $Eleveurproprietaire->Etat = 'Deactive';
        $Eleveurproprietaire->save();
        $Eleveurproprietaire->delete();
        return response()->json(['msg' => 'Eleveurproprietaire Deleted']);
    }
}
