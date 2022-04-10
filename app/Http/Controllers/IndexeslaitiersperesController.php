<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexeslaitiersperesCollection;
use App\Http\Resources\IndexeslaitiersperesResource;
use App\Models\Indexeslaitierspere;
use Illuminate\Http\Request;

class IndexeslaitiersperesController extends Controller
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
                $indexeslaitiersperes = Indexeslaitierspere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new IndexeslaitiersperesCollection($indexeslaitiersperes);
            } else {
                $indexeslaitiersperes = Indexeslaitierspere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new IndexeslaitiersperesCollection($indexeslaitiersperes);
            }
        } else {
            $indexeslaitiersperes = Indexeslaitierspere::all();
            return new IndexeslaitiersperesCollection($indexeslaitiersperes);
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
            'Lait'  => 'nullable',
            //'MG' => 'nullable|numeric|between:0,9.999',
            'MGkg'  => 'nullable|numeric',
            //'Prot'  => 'nullable|numeric|between:0,9.999',
            'ProtKg' => 'nullable|numeric',
            'Precision'  => 'nullable|numeric',

        ]);

        $Indexeslaitierspere = Indexeslaitierspere::create([
            'Lait'   => $request->Lait,
            'MG'  => $request->MG,
            'MGkg'   => $request->MGkg,
            'Prot'   => $request->Prot,
            'ProtKg'  => $request->ProtKg,
            'Precision'  => $request->Precision,
            'pere_id' => $request->pere_id,
            'user_id'  => auth()->user()->id,

        ]);
        return new IndexeslaitiersperesResource($Indexeslaitierspere);
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
        $Indexeslaitierspere = Indexeslaitierspere::findOrFail($id);
        return new IndexeslaitiersperesResource($Indexeslaitierspere);
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
        $Indexeslaitierspere = Indexeslaitierspere::findOrFail($id);

        $request->validate([
            'MG' => 'Nullable|numeric|between:0,9.999',
            'MGkg'  => 'Nullable|numeric',
            'Prot'  => 'Nullable|numeric|between:0,9.999',
            'ProtKg' => 'Nullable|numeric',
            'Precision'  => 'Nullable|numeric',


        ]);
        if ($request->has('Lait') && !empty($request->Lait)) {
            $Indexeslaitierspere->Lait = $request->Lait;
        };
        if ($request->has('MG') && !empty($request->MG)) {
            $Indexeslaitierspere->MG = $request->MG;
        };
        if ($request->has('MGkg') && !empty($request->MGkg)) {
            $Indexeslaitierspere->MGkg = $request->MGkg;
        };
        if ($request->has('Prot') && !empty($request->Prot)) {
            $Indexeslaitierspere->Prot = $request->Prot;
        };
        if ($request->has('ProtKg') && !empty($request->ProtKg)) {
            $Indexeslaitierspere->ProtKg = $request->ProtKg;
        };
        if ($request->has('Precision') && !empty($request->Precision)) {
            $Indexeslaitierspere->Precision = $request->Precision;
        };

        $Indexeslaitierspere->update([
             'Lait'   => $Indexeslaitierspere->Lait,
            'MG'  => $Indexeslaitierspere->MG,
            'MGkg'   => $Indexeslaitierspere->MGkg,
            'Prot'   => $Indexeslaitierspere->Prot,
            'ProtKg'  => $Indexeslaitierspere->ProtKg,
            'Precision'  => $Indexeslaitierspere->Precision,

        ]);
        return new IndexeslaitiersperesResource($Indexeslaitierspere);
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
        $Indexeslaitierspere = Indexeslaitierspere::findOrFail($id);
        $Indexeslaitierspere->forceDelete();
        return response()->json(['msg' => 'Indexeslaitierspere Deleted']);
    }
}
