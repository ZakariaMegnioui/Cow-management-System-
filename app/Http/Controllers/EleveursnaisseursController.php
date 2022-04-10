<?php

namespace App\Http\Controllers;

use App\Http\Resources\EleveursnaisseursCollection;
use App\Http\Resources\EleveursnaisseursResource;
use App\Models\Eleveurnaisseur;
use Illuminate\Http\Request;
use PhpParser\Node\Identifier;

class EleveursnaisseursController extends Controller
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
                $Eleveursnaisseurs = Eleveurnaisseur::whereBetween('created_at', [$dateDebut, $DateFin])->withCount('sujets')->withTrashed()->latest()->get();
                return new EleveursnaisseursCollection($Eleveursnaisseurs);
            }
        } else {
            $Eleveursnaisseurs = Eleveurnaisseur::withCount('sujets')->withTrashed()->latest()->get();
            return new EleveursnaisseursCollection($Eleveursnaisseurs);
        }
    }

    public function getCount()
    {
        $EleveursnaisseursCount = Eleveurnaisseur::distinct('Nom', 'Prenom')->count('NSNIT');
        return response()->json(['NbrEleveursnaisseurs' => $EleveursnaisseursCount]);
    }
    public function Activate($id)
    {
        $Naisseur = Eleveurnaisseur::withTrashed()->findOrFail($id);
        $Naisseur->deleted_at = Null;
        $Naisseur->Etat = 'Active';
        $Naisseur->save();
        return response()->json(['Msg' => 'Naisseur Activer']);
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
        $ExNaisseur = Eleveurnaisseur::where('CIN', $request->CIN)->withTrashed()->first();
        if (!empty($ExNaisseur)) {
            return response()->json([
                'Msg' => 'Naisseur Deja Exists',
                'Naisseur' => $ExNaisseur,
                'id'  => $ExNaisseur->id,
            ]);
        } elseif (empty($ExNaisseur) && $request->sreach !== true) {
            $Eleveurnaisseur = Eleveurnaisseur::create([
                'Nom' => $request->Nom,
                'Prenom' => $request->Prenom,
                'Adresse' => $request->Adresse,
                'CIN' => $request->CIN,
                'Etat' => 'Active',
                'user_id' => auth()->user()->id,
            ]);
            return new EleveursnaisseursResource($Eleveurnaisseur);
        } else {
            return response()->json([
                'message' => 'Naisseur Non Exists',
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
        $Eleveurnaisseur = Eleveurnaisseur::findOrFail($id);
        return new EleveursnaisseursResource($Eleveurnaisseur);
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
        $Eleveurnaisseur = Eleveurnaisseur::findOrFail($id);

        $request->validate([
            'Nom' => 'Max:21',
            'Prenom' => 'Max:17',
            'Adresse' => 'Max:42',

        ]);
        if ($request->has('Nom') && !empty($request->Nom)) {
            $Eleveurnaisseur->Nom = $request->Nom;
        }
        if ($request->has('Prenom') && !empty($request->Prenom)) {
            $Eleveurnaisseur->Prenom = $request->Prenom;
        }
        if ($request->has('Adresse') && !empty($request->Adresse)) {
            $Eleveurnaisseur->Adresse = $request->Adresse;
        }

        if ($request->has('user_id') && !empty($request->user_id)) {
            $Eleveurnaisseur->user_id = $request->user_id;
        }
        // if ($request->has('CIN') && !empty($request->CIN)) {
            $Eleveurnaisseur->CIN = $request->CIN;
        // }

        $Eleveurnaisseur->update([
            'Nom' => $Eleveurnaisseur->Nom,
            'Prenom' => $Eleveurnaisseur->Prenom,
            'Etat' => 'Active',
            'Adresse' => $Eleveurnaisseur->Adresse,
            'user_id' => $Eleveurnaisseur->user_id,
            'CIN' => $Eleveurnaisseur->CIN,
        ]);
        return new EleveursnaisseursResource($Eleveurnaisseur);
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
        $Eleveurnaisseur = Eleveurnaisseur::findOrFail($id);
        $Eleveurnaisseur->Etat = 'Deactive';
        $Eleveurnaisseur->save();
        $Eleveurnaisseur->delete();
        return response()->json(['message' => 'Eleveurnaisseur Deleted']);
    }
}
