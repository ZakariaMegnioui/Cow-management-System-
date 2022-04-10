<?php

namespace App\Http\Controllers;

use App\Models\Mere;
use App\Models\Pere;
use App\Models\Sujet;
use Illuminate\Support\Str;
use App\Laravue\Models\User;
use Illuminate\Http\Request;
use App\Models\Eleveurnaisseur;
use App\Models\Grandperematernel;
use App\Models\Grandperepaternel;
use Illuminate\Support\Facades\DB;
use App\Models\Eleveurproprietaire;
use App\Models\Grandmerematernelle;
use App\Models\Grandmerepaternelle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SujetResource;
use App\Http\Resources\SujetCollection;
use App\Models\Productionlaitieresujet;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class SujetsController extends Controller
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
                $Sujets = Sujet::whereBetween('created_at', [$dateDebut, $DateFin])->with('user')->withTrashed()->get();
                return new SujetCollection($Sujets);
            }
        } else {
            $Sujets = Sujet::with('user')->withTrashed()->latest()->get();
            return new SujetCollection($Sujets);
        }
    }

    // Activate Sujet
    public function Activate($id)
    {
        $sujet = Sujet::withTrashed()->findOrFail($id);
        $sujet->deleted_at = Null;
        $sujet->Etat = 'Active';
        $sujet->Cause = '';
        $sujet->InfoCause = '';
        $sujet->save();
        return response()->json(['Msg' => 'Sujet Activer']);
    }
    // Get Count Suet
    public function getCount()
    {
        $SujetCount = Sujet::distinct('NSNIT')->count('NSNIT');
        $EVN = Eleveurnaisseur::All();
        $EVP = Eleveurproprietaire::All();
        $RIJ = Sujet::select('Adresse')->distinct()->get()->toArray();
        return response()->json(compact(['SujetCount', 'EVN', 'EVP', 'RIJ']));
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
            //     'NSNIT' => 'nullable|Max:16',
            //     'DateNaissance' => 'nullable',
            //     'Race' => 'nullable|Max:8',
            //     'NTravail' => 'required|Max:45',
            //     'Type' => 'nullable|Max:45',
            //     'Etat' => 'nullable|Max:45',
            //     'Sexe' => 'nullable|Max:45',
            //     'Adresse' => 'nullable',
            //     'user_id' => 'required',
            //    'meres_ID'=>'nullable',
            // 'peres_ID'=>'nullable',
            // 'GrandPerePaternels_ID'=>'nullable',
            // 'GrandPereMaternels_ID'=>'nullable',
            // 'GrandMerePaternelles_ID'=>'nullable',
            // 'GrandMereMaternelles_ID'=>'nullable',
            // 'EleveurProprietaires_ID'=>'nullable',
            // 'EleveurNaisseurs_ID'=>'nullable',
        ]);

        $ExSujet = Sujet::where('NTravail', $request->NTravail)->withTrashed()->count();
        if ($ExSujet > 0) {
            return response()->json(['Msg' => "Sujet Exist Deja "]);
        } else if ($ExSujet == 0) {
            // if ($request->hasFile("Image1")) {
            //     // $file = $request->Image1;
            //     /* $imageName = "images/SujetImages/"  . $file->getClientOriginalName();
            // $file->move(public_path("images/SujetImages"), $imageName);*/
            //     //  $image1Path = $request->file('Image1')->store('images', 'public');
            //     $file = $request->file('Image1');
            //     $imageName = "images/"  . $file->getClientOriginalName();
            //     $file->move(public_path("images"), $imageName);
            // }
            $Sujet = Sujet::create([

                'NSNIT' => $request->NSNIT,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'NTravail' => $request->NTravail,
                'Type' => $request->Type,
                'Adresse' => $request->Adresse,
                'Etat' => 'Active',
                'Sexe' => $request->Sexe,
                // 'image1' => $imageName,
                'InfoCause' => '',
                'Cause' => '',
                'user_id'  => auth()->user()->id,
                'meres_ID' => $request->meres_ID,
                'peres_ID' => $request->peres_ID,
                'GrandPerePaternels_ID' => $request->GrandPerePaternels_ID,
                'GrandPereMaternels_ID' => $request->GrandPereMaternels_ID,
                'GrandMerePaternelles_ID' => $request->GrandMerePaternelles_ID,
                'GrandMereMaternelles_ID' => $request->GrandMereMaternelles_ID,
                'EleveurProprietaires_ID' => $request->EleveurProprietaires_ID,
                'EleveurNaisseurs_ID' => $request->EleveurNaisseurs_ID,

            ]);

            return  new SujetResource($Sujet);
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
        $Sujet = Sujet::where('id', $id)->with('eleveurproprietaire', 'eleveurnaisseur', 'mere', 'pere', 'Grandperepaternel', 'Grandperematernel', 'Grandmerepaternelle', 'Grandmerematernelle', 'user')->withTrashed()->first();
        return new SujetResource($Sujet);
    }
    public function pdfGeneratorData($id, $status)
    {


         $Sujet = Sujet::where('id', $id)->withTrashed()->first();
        $Mere = Mere::find($Sujet->meres_ID);
        $Pere = Pere::find($Sujet->peres_ID);
        $GPP = Grandperepaternel::find($Sujet->GrandPerePaternels_ID);
        $GPM = Grandperematernel::find($Sujet->GrandPereMaternels_ID);
        $GMP = Grandmerepaternelle::find($Sujet->GrandMerePaternelles_ID);
        $GMM = Grandmerematernelle::find($Sujet->GrandMereMaternelles_ID);
        $EP = Eleveurproprietaire::find($Sujet->EleveurProprietaires_ID);
        $EN = Eleveurnaisseur::find($Sujet->EleveurNaisseurs_ID);

        if ($status !== "update") {
            $PLS = ($Sujet) ? DB::table('productionlaitieresujets')->where('sujet_id', $Sujet->id)->take(3)->get() : [];
            $PLM = ($Mere) ? DB::table('productionlaitieremeres')->where('meres_ID', $Mere->id)->take(2)->get() : [];
            $PLMM  = ($GMM) ? DB::table('productionlaitieregrandmerematernelles')->where('GMMaternelle_Id', $GMM->id)->take(2)->get() : [];
        } else {
            $PLS = ($Sujet) ? DB::table('productionlaitieresujets')->where('sujet_id', $Sujet->id)->get() : [];
            $PLM = ($Mere) ? DB::table('productionlaitieremeres')->where('meres_ID', $Mere->id)->get() : [];
            $PLMM  = ($GMM) ? DB::table('productionlaitieregrandmerematernelles')->where('GMMaternelle_Id', $GMM->id)->get() : [];
        }
        $indexLAIT = ($Pere) ? DB::table('indexeslaitiersperes')->where('pere_id', $Pere->id)->take(1)->get() : [];
        $indexPHOL = ($Pere) ? DB::table('indexesmorphologiquesperes')->where('pere_id', $Pere->id)->take(1)->get() : [];
        $indexFOC = ($Pere) ? DB::table('indexfonctionnelsperes')->where('pere_id', $Pere->id)->take(1)->get() : [];


        $data = array(

            "indexPHOL"  =>  $indexPHOL, "indexFOC" => $indexFOC, "indexLAIT" => $indexLAIT,  'PLMM' => $PLMM, 'PLM' => $PLM, 'PLS' => $PLS, 'sujet' => $Sujet, 'mere' => $Mere, 'pere' => $Pere, 'GPP' => $GPP, 'GPM' => $GPM, 'GMP' => $GMP, 'GMM' => $GMM, 'EP' => $EP, 'EN' => $EN
        );


        return response()->json(['Pdf' => $data]);
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
    public function SortCause(Request $request, $id)
    {
        $Sujet = Sujet::where('id', $id)->withTrashed()->first();
        $Sujet->Cause = $request->SortValue;
        $Sujet->InfoCause = $request->infoCause;
        $Sujet->Etat = 'Sorte';
        $Sujet->save();
        return response()->json(['msg' => 'Bien Modifier']);
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
        $request->validate([
            /*'NSNIT' => 'Max:16',
            'Race' => 'Max:8',
            'NTravail' => 'Max:45',
            'Type' => 'Max:45',
            'Etat' => 'Max:45',
            'Sexe' => 'Max:45',*/]);
        $Sujet = Sujet::findOrFail($id);
        if ($request->has('NSNIT') && !empty($request->NSNIT)) {
            $Sujet->NSNIT = $request->NSNIT;
        }
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Sujet->DateNaissance = $request->DateNaissance;
        }
        if ($request->has('Race') && !empty($request->Race)) {
            $Sujet->Race = $request->Race;
        }
        if ($request->has('NTravail') && !empty($request->NTravail)) {
            $Sujet->NTravail = $request->NTravail;
        }

        if ($request->has('Type') && !empty($request->Type)) {
            $Sujet->Type = $request->Type;
        };
        if ($request->has('Etat') && !empty($request->Etat)) {
            $Sujet->Etat = $request->Etat;
        };
        if ($request->has('Sexe') && !empty($request->Sexe)) {
            $Sujet->Sexe = $request->Sexe;
        };
        if ($request->has('Adresse') && !empty($request->Adresse)) {
            $Sujet->Adresse = $request->Adresse;
        };
        if ($request->has('meres_ID') && !empty($request->meres_ID)) {
            $Sujet->meres_ID = $request->meres_ID;
        };
        if ($request->has('peres_ID') && !empty($request->peres_ID)) {
            $Sujet->peres_ID = $request->peres_ID;
        };
        if ($request->has('GrandPerePaternels_ID') && !empty($request->GrandPerePaternels_ID)) {
            $Sujet->GrandPerePaternels_ID = $request->GrandPerePaternels_ID;
        };
        if ($request->has('GrandPereMaternels_ID') && !empty($request->GrandPereMaternels_ID)) {
            $Sujet->GrandPereMaternels_ID = $request->GrandPereMaternels_ID;
        };
        if ($request->has('GrandMerePaternelles_ID') && !empty($request->GrandMerePaternelles_ID)) {
            $Sujet->GrandMerePaternelles_ID = $request->GrandMerePaternelles_ID;
        };
        if ($request->has('GrandMereMaternelles_ID') && !empty($request->GrandMereMaternelles_ID)) {
            $Sujet->GrandMereMaternelles_ID = $request->GrandMereMaternelles_ID;
        };
        if ($request->has('EleveurProprietaires_ID') && !empty($request->EleveurProprietaires_ID)) {
            $Sujet->EleveurProprietaires_ID = $request->EleveurProprietaires_ID;
        };
        if ($request->has('EleveurNaisseurs_ID') && !empty($request->EleveurNaisseurs_ID)) {
            $Sujet->EleveurNaisseurs_ID = $request->EleveurNaisseurs_ID;
        };
        $Sujet = Sujet::findOrFail($id);
        if ($request->image) {
            $image_64 = $request->image; //your base64 encoded data

           $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

            // find substring fro replace here eg: data:image/png;base64,

            $image = str_replace($replace, '', $image_64);

            $image = str_replace(' ', '+', $image);

            $imageName = Str::random(6) . time() . '.' . $extension;
            Storage::disk("public")->put("sujet_Images/" . $imageName, base64_decode($image));

            $Sujet->update([

                ($request->type)    => $imageName,

            ]);

            return response()->json(['msg' => "l'image a été téléchargée"]);
        }
        $Sujet->update([
            // 'id'                         => $Sujet->id,
            'NSNIT'                      => $Sujet->NSNIT,
            'DateNaissance'              => $Sujet->DateNaissance,
            'Race'                       => $Sujet->Race,
            'NTravail'                   => $Sujet->NTravail,
            // 'user_id'                    => $Sujet->user_id,
            'Sexe'                       => $Sujet->Sexe,
            'Etat'                       => $Sujet->Etat,
            'Type'                       => $Sujet->Type,
            'Adresse'                    => $Sujet->Adresse,
            'meres_ID'                   => $Sujet->meres_ID,
            'peres_ID'                   => $Sujet->peres_ID,
            'GrandPerePaternels_ID'      => $Sujet->GrandPerePaternels_ID,
            'GrandPereMaternels_ID'      => $Sujet->GrandPereMaternels_ID,
            'GrandMerePaternelles_ID'    => $Sujet->GrandMerePaternelles_ID,
            'GrandMereMaternelles_ID'    => $Sujet->GrandMereMaternelles_ID,
            'EleveurProprietaires_ID'    => $Sujet->EleveurProprietaires_ID,
            'EleveurNaisseurs_ID'        => $Sujet->EleveurNaisseurs_ID,
        ]);

        // return new SujetResource($Sujet);
        return response()->json(['Msg' => 'Sujet bien modifier']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {


        $Sujet = Sujet::findOrFail($id);
        $Sujet->delete();
        /*$Sujet->Etat = 'Sorte';
        $Sujet->save();*/
        return response()->json(['message' => "Sujet Deleted"]);
    }
}
