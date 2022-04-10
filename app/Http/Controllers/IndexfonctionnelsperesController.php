<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexfonctionnelsperesCollection;
use App\Http\Resources\IndexfonctionnelsperesResource;
use App\Models\Indexfonctionnelspere;
use Illuminate\Http\Request;

class IndexfonctionnelsperesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!empty($request->search) || !empty($request->dateD && $request->dateF)) {
            if (!empty($request->dateD) && !empty($request->dateF)) {
                $dateDebut = date("Y-m-d H:i:s", strtotime($request->dateD . '00:00:00'));
                $DateFin = date("Y-m-d H:i:s", strtotime($request->dateF . '23:59:59'));
                $Indexfonctionnelsperes = Indexfonctionnelspere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new IndexfonctionnelsperesCollection($Indexfonctionnelsperes);
            } else {
                $Indexfonctionnelsperes = Indexfonctionnelspere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new IndexfonctionnelsperesCollection($Indexfonctionnelsperes);
            }
        } else {
            $Indexfonctionnelsperes = Indexfonctionnelspere::all();
            return new IndexfonctionnelsperesCollection($Indexfonctionnelsperes);
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
            'SCS' => 'nullable|Numeric|between:0,9.999',
            'LONG' => 'nullable|Numeric|between:0,9.99',
            'FERT' => 'nullable|Numeric|between:0,9.99',
            'FN' => 'nullable|Numeric|between:0,9.99',
            'FV' => 'nullable|Numeric|between:0,9.99',
            'Precision' => 'nullable|Numeric',
        ]);

        $Indexfonctionnelspere = Indexfonctionnelspere::create([
            'SCS' => $request->SCS,
            'LONG' => $request->LONG,
            'FERT' => $request->FERT,
            'FN' => $request->FN,
            'FV' => $request->FV,
            'Precision' => $request->Precision,
            'pere_id' => $request->pere_id,
            'user_id'  => auth()->user()->id,
        ]);
        return new IndexfonctionnelsperesResource($Indexfonctionnelspere);
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
        $Indexfonctionnelspere = Indexfonctionnelspere::findOrFail($id);
        return new IndexfonctionnelsperesResource($Indexfonctionnelspere);
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
        $Indexfonctionnelspere = Indexfonctionnelspere::findOrFail($id);
        $request->validate([
            'SCS' => 'Numeric|between:0,9.999',
            'LONG' => 'Numeric|between:0,9.999',
            'FERT' => 'Numeric|between:0,9.999',
            'FN' => 'Numeric|between:0,9.999',
            'FV' => 'Numeric|between:0,9.999',
            'Precision' => 'Numeric',
            'sujet_id' => 'Numeric',
            'user_id' => 'Numeric',
        ]);
        if ($request->has('SCS') && !empty($request->SCS)) {
            $Indexfonctionnelspere->SCS = $request->SCS;
        };
        if ($request->has('LONG') && !empty($request->LONG)) {
            $Indexfonctionnelspere->LONG = $request->LONG;
        };
        if ($request->has('FERT') && !empty($request->FERT)) {
            $Indexfonctionnelspere->FERT = $request->FERT;
        };
        if ($request->has('FN') && !empty($request->FN)) {
            $Indexfonctionnelspere->FN = $request->FN;
        };

        if ($request->has('FV') && !empty($request->FV)) {
            $Indexfonctionnelspere->FV = $request->FV;
        };
        if ($request->has('Precision') && !empty($request->Precision)) {
            $Indexfonctionnelspere->Precision = $request->Precision;
        };



        $Indexfonctionnelspere->update([
            // 'ID'=>$Indexfonctionnelspere->ID,
            'SCS' => $Indexfonctionnelspere->SCS,
            'LONG' => $Indexfonctionnelspere->LONG,
            'FERT' => $Indexfonctionnelspere->FERT,
            'FN' => $Indexfonctionnelspere->FN,
            'FV' => $Indexfonctionnelspere->FV,
            'Precision' => $Indexfonctionnelspere->Precision,

        ]);
        return new IndexfonctionnelsperesResource($Indexfonctionnelspere);
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
        $Indexfonctionnelspere = Indexfonctionnelspere::findOrFail($id);
        $Indexfonctionnelspere->forceDelete();
        return response()->json(['msg' => 'Indexfonctionnelspere Deleted']);
    }
}
