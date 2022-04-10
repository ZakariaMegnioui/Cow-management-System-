<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductionlaitieremeresCollection;
use App\Http\Resources\ProductionlaitieremeresResource;
use Illuminate\Http\Request;
use App\Models\Productionlaitieremere;

class ProductionlaitieremeresController extends Controller
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
                $Productionlaitieremeres = Productionlaitieremere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new ProductionlaitieremeresCollection($Productionlaitieremeres);
            } else {
                $Productionlaitieremeres = Productionlaitieremere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new ProductionlaitieremeresCollection($Productionlaitieremeres);
            }
        } else {
            $Productionlaitieremeres = Productionlaitieremere::all();
            return new ProductionlaitieremeresCollection($Productionlaitieremeres);
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

        $Productionlaitieremere = Productionlaitieremere::create([
            'NLACT' => $request->NLACT,
            'AgeVelage' => $request->AgeVelage,
            'KgLait' => $request->KgLait,
            'MG' => $request->MG,
            'KgMG' => $request->KgMG,
            'Prot' => $request->Prot,
            'KgProt' => $request->KgProt,
            'meres_ID' => $request->meres_ID,
            'user_id' => auth()->user()->id,


        ]);
        return new ProductionlaitieremeresResource($Productionlaitieremere);
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
        $Productionlaitieremere = Productionlaitieremere::findOrFail($id);
        return new ProductionlaitieremeresResource($Productionlaitieremere);
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

        $Productionlaitieremere = Productionlaitieremere::findOrFail($id);
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
            $Productionlaitieremere->NLACT = $request->NLACT;
        };
        if ($request->has('AgeVelage') && !empty($request->AgeVelage)) {
            $Productionlaitieremere->AgeVelage = $request->AgeVelage;
        };
        if ($request->has('KgLait') && !empty($request->KgLait)) {
            $Productionlaitieremere->KgLait = $request->KgLait;
        };
        if ($request->has('MG') && !empty($request->MG)) {
            $Productionlaitieremere->MG = $request->MG;
        };
        if ($request->has('KgMG') && !empty($request->KgMG)) {
            $Productionlaitieremere->KgMG = $request->KgMG;
        };
        if ($request->has('Prot') && !empty($request->Prot)) {
            $Productionlaitieremere->Prot = $request->Prot;
        };
        if ($request->has('KgProt') && !empty($request->KgProt)) {
            $Productionlaitieremere->KgProt = $request->KgProt;
        };




        $Productionlaitieremere->update([
            'NLACT' => $Productionlaitieremere->NLACT,
            'AgeVelage' => $Productionlaitieremere->AgeVelage,
            'KgLait' => $Productionlaitieremere->KgLait,
            'MG' => $Productionlaitieremere->MG,
            'KgMG' => $Productionlaitieremere->KgMG,
            'Prot' => $Productionlaitieremere->Prot,
            'KgProt' => $Productionlaitieremere->KgProt,


        ]);
        return new ProductionlaitieremeresResource($Productionlaitieremere);
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
        $Productionlaitieremere = Productionlaitieremere::findOrFail($id);
        $Productionlaitieremere->forceDelete();
        return response()->json(['msg' => 'Productionlaitieremere Dleted']);
    }
}
