<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductionlaitieresujetsCollection;
use App\Http\Resources\ProductionlaitieresujetsResource;
use App\Models\Productionlaitieresujet;
use Illuminate\Http\Request;

class ProductionlaitieresujetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!empty($request->search)  || !empty($request->dateD && $request->dateF)) {

            if (!empty($request->dateD) && !empty($request->dateF)) {
                $dateDebut = date("Y-m-d H:i:s", strtotime($request->dateD . '00:00:00'));
                $DateFin = date("Y-m-d H:i:s", strtotime($request->dateF . '23:59:59'));
                $Productionlaitieresujets = Productionlaitieresujet::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new ProductionlaitieresujetsCollection($Productionlaitieresujets);
            } else {
                $Productionlaitieresujets = Productionlaitieresujet::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new ProductionlaitieresujetsCollection($Productionlaitieresujets);
            }
        } else {
            $Productionlaitieremeres = Productionlaitieresujet::all();
            return new ProductionlaitieresujetsCollection($Productionlaitieremeres);
        }
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
            'NLACT' => 'nullable',
            'AgeVelage' => 'nullable|Max:9',
            'KgLait' => 'nullable|Numeric|between:0,99.99',
            'MG' => 'nullable|Numeric|between:0,99.99',
            'KgMG' => 'nullable|Numeric|between:0,99.99',
            'Prot' => 'nullable|Numeric|between:0,99.99',
            'KgProt' => 'nullable|Numeric|between:0,99.99',

        ]);
        $Productionlaitieresujet = Productionlaitieresujet::create([
            'NLACT' => $request->NLACT,
            'AgeVelage' => $request->AgeVelage,
            'KgLait' => $request->KgLait,
            'MG' => $request->MG,
            'KgMG' => $request->KgMG,
            'Prot' => $request->Prot,
            'KgProt' => $request->KgProt,
            'sujet_id' => $request->sujet_id,
            'user_id' => auth()->user()->id,


        ]);
        return new ProductionlaitieresujetsResource($Productionlaitieresujet);
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
        $Productionlaitieresujet = Productionlaitieresujet::findOrFail($id);
        return new ProductionlaitieresujetsResource($Productionlaitieresujet);
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
        $Productionlaitieresujet = Productionlaitieresujet::findOrFail($id);
        $request->validate([
            'NLACT' => 'nullable',
            'AgeVelage' => 'nullable|Max:9',
            'KgLait' => 'nullable|Numeric|between:0,99.99',
            'MG' => 'nullable|Numeric|between:0,99.99',
            'KgMG' => 'nullable|Numeric|between:0,99.99',
            'Prot' => 'nullable|Numeric|between:0,99.99',
            'KgProt' => 'nullable|Numeric|between:0,99.99',

        ]);
        if ($request->has('NLACT') && !empty($request->NLACT)) {
            $Productionlaitieresujet->NLACT = $request->NLACT;
        };
        if ($request->has('AgeVelage') && !empty($request->AgeVelage)) {
            $Productionlaitieresujet->AgeVelage = $request->AgeVelage;
        };
        if ($request->has('KgLait') && !empty($request->KgLait)) {
            $Productionlaitieresujet->KgLait = $request->KgLait;
        };
        if ($request->has('MG') && !empty($request->MG)) {
            $Productionlaitieresujet->MG = $request->MG;
        };
        if ($request->has('KgMG') && !empty($request->KgMG)) {
            $Productionlaitieresujet->KgMG = $request->KgMG;
        };
        if ($request->has('Prot') && !empty($request->Prot)) {
            $Productionlaitieresujet->Prot = $request->Prot;
        };
        if ($request->has('KgProt') && !empty($request->KgProt)) {
            $Productionlaitieresujet->KgProt = $request->KgProt;
        };



        $Productionlaitieresujet->update([
            'NLACT' => $Productionlaitieresujet->NLACT,
            'AgeVelage' => $Productionlaitieresujet->AgeVelage,
            'KgLait' => $Productionlaitieresujet->KgLait,
            'MG' => $Productionlaitieresujet->MG,
            'KgMG' => $Productionlaitieresujet->KgMG,
            'Prot' => $Productionlaitieresujet->Prot,
            'KgProt' => $Productionlaitieresujet->KgProt,
        ]);
        return new ProductionlaitieresujetsResource($Productionlaitieresujet);
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
        $Productionlaitieresujet = Productionlaitieresujet::findOrFail($id);
        $Productionlaitieresujet->forceDelete();
        return response()->json(['msg' => "Productionlaitieresujet Deleted"]);
    }
}
