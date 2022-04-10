<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductionlaitieregrandmerematernellesCollection;
use App\Http\Resources\ProductionlaitieregrandmerematernellesResource;
use App\Models\Productionlaitieregrandmerematernelle;
use App\Models\Productionlaitieremere;
use Illuminate\Http\Request;

class ProductionlaitieregrandmerematernellesController extends Controller
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
                $Productionlaitieregrandmerematernelles = Productionlaitieregrandmerematernelle::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new ProductionlaitieregrandmerematernellesCollection($Productionlaitieregrandmerematernelles);
            } else {
                $Productionlaitieregrandmerematernelles = Productionlaitieregrandmerematernelle::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new ProductionlaitieregrandmerematernellesCollection($Productionlaitieregrandmerematernelles);
            }
        } else {
            $Productionlaitieregrandmerematernelles = Productionlaitieregrandmerematernelle::all();
            return new ProductionlaitieregrandmerematernellesCollection($Productionlaitieregrandmerematernelles);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'N_LACT' => 'nullable',
            'Age_V_lage' => 'nullable|Max:9',
            'Kg_Lait' => 'nullable|Max:19',
            'MG' => 'nullable|Numeric|between:0,99.99',
            'KgMG' => 'nullable|Numeric|between:0,99.99',
            'Prot' => 'nullable|Numeric|between:0,99.99',
            'KgProt' => 'nullable|Numeric|between:0,99.99',

        ]);
        $Productionlaitieregrandmerematernelle = Productionlaitieregrandmerematernelle::create([
            'N_LACT' => $request->N_LACT,
            'Age_V_lage' => $request->Age_V_lage,
            'Kg_Lait' => $request->Kg_Lait,
            'MG' => $request->MG,
            'KgMG' => $request->KgMG,
            'Prot' => $request->Prot,
            'KgProt' => $request->KgProt,
            'GMMaternelle_Id' => $request->GMMaternelle_Id,
            'user_id' => auth()->user()->id,

        ]);
        return new ProductionlaitieregrandmerematernellesResource($Productionlaitieregrandmerematernelle);
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
        $Productionlaitieregrandmerematernelle = Productionlaitieregrandmerematernelle::findOrFail($id);
        return new ProductionlaitieregrandmerematernellesResource($Productionlaitieregrandmerematernelle);
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

        $Productionlaitieregrandmerematernelle = Productionlaitieregrandmerematernelle::findOrFail($id);
        $request->validate([
            // 'ID'=>'required||Unique:productionlaitieregrandmerematernelles,ID',
            'N_LACT' => 'nullable',
            'Age_V_lage' => 'nullable|Max:9',
            'Kg_Lait' => 'nullable|Max:18',
            'MG' => 'nullable|Numeric|between:0,9.99',
            'KgMG' => 'nullable|Numeric|between:0,9.99',
            'Prot' => 'nullable|Numeric|between:0,9.99',
            'KgProt' => 'nullable|Numeric|between:0,9.99',


        ]);

        if ($request->has('N_LACT') && !empty($request->N_LACT)) {
            $Productionlaitieregrandmerematernelle->N_LACT = $request->N_LACT;
        };
        if ($request->has('Age_V_lage') && !empty($request->Age_V_lage)) {
            $Productionlaitieregrandmerematernelle->Age_V_lage = $request->Age_V_lage;
        };
        if ($request->has('Kg_Lait') && !empty($request->Kg_Lait)) {
            $Productionlaitieregrandmerematernelle->Kg_Lait = $request->Kg_Lait;
        };
        if ($request->has('MG') && !empty($request->MG)) {
            $Productionlaitieregrandmerematernelle->MG = $request->MG;
        };
        if ($request->has('KgMG') && !empty($request->KgMG)) {
            $Productionlaitieregrandmerematernelle->KgMG = $request->KgMG;
        };
        if ($request->has('Prot') && !empty($request->Prot)) {
            $Productionlaitieregrandmerematernelle->Prot = $request->Prot;
        };
        if ($request->has('KgProt') && !empty($request->KgProt)) {
            $Productionlaitieregrandmerematernelle->KgProt = $request->KgProt;
        };

        $Productionlaitieregrandmerematernelle->update([
            'N_LACT' => $Productionlaitieregrandmerematernelle->N_LACT,
            'Age_V_lage' => $Productionlaitieregrandmerematernelle->Age_V_lage,
            'Kg_Lait' => $Productionlaitieregrandmerematernelle->Kg_Lait,
            'MG' => $Productionlaitieregrandmerematernelle->MG,
            'KgMG' => $Productionlaitieregrandmerematernelle->KgMG,
            'Prot' => $Productionlaitieregrandmerematernelle->Prot,
            'KgProt' => $Productionlaitieregrandmerematernelle->KgProt,

        ]);
        return new ProductionlaitieregrandmerematernellesResource($Productionlaitieregrandmerematernelle);
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
        $Productionlaitieregrandmerematernelle = Productionlaitieregrandmerematernelle::findOrFail($id);
        $Productionlaitieregrandmerematernelle->forceDelete();
        return response()->json(['msg' => 'Productionlaitieregrandmerematernelle Deleted']);
    }
}
