<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexesmorphologiquesperesCollection;
use App\Http\Resources\IndexesmorphologiquesperesResource;
use App\Models\Indexesmorphologiquespere;
use Illuminate\Http\Request;

class IndexesmorphologiquesperesController extends Controller
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
                $Indexesmorphologiquesperes = Indexesmorphologiquespere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new IndexesmorphologiquesperesCollection($Indexesmorphologiquesperes);
            } else {
                $Indexesmorphologiquesperes = Indexesmorphologiquespere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new IndexesmorphologiquesperesCollection($Indexesmorphologiquesperes);
            }
        } else {
            $Indexesmorphologiquesperes = Indexesmorphologiquespere::all();
            return new IndexesmorphologiquesperesCollection($Indexesmorphologiquesperes);
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
            'Devel' => 'nullable|numeric|between:0,9.999',
            'TypeBassin' => 'nullable|numeric',
            'Membres' => 'nullable|numeric|between:0,9.999',
            'Pis' => 'nullable|numeric|between:0,9.999',
            'Precision' => 'nullable|numeric',

        ]);

        $Indexesmorphologiquespere = Indexesmorphologiquespere::create([
            'Devel' => $request->Devel,
            'TypeBassin' => $request->TypeBassin,
            'Membres' => $request->Membres,
            'Pis' => $request->Pis,
            'Precision' => $request->Precision,
            'pere_id' => $request->pere_id,
            'user_id'  => auth()->user()->id


        ]);
        return new IndexesmorphologiquesperesResource($Indexesmorphologiquespere);
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
        $Indexesmorphologiquespere = Indexesmorphologiquespere::findOrFail($id);
        return new IndexesmorphologiquesperesResource($Indexesmorphologiquespere);
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
        $Indexesmorphologiquespere = Indexesmorphologiquespere::findOrFail($id);

        $request->validate([
            'Devel' => 'numeric|between:0,9.999',
            'TypeBassin' => '|numeric',
            'Membres' => 'numeric|between:0,9.999',
            'Pis' => 'numeric|between:0,9.999',
            'Precision' => 'numeric',
            'sujet_id' => 'numeric',
            'user_id' => 'numeric',


        ]);
        /*if($request->has('ID') && !empty($request->ID)){
            $Indexesmorphologiquespere->ID= $request->ID;
        };*/
        if ($request->has('Devel') && !empty($request->Devel)) {
            $Indexesmorphologiquespere->Devel = $request->Devel;
        };
        if ($request->has('TypeBassin') && !empty($request->TypeBassin)) {
            $Indexesmorphologiquespere->TypeBassin = $request->TypeBassin;
        };
        if ($request->has('Membres') && !empty($request->Membres)) {
            $Indexesmorphologiquespere->Membres = $request->Membres;
        };
        if ($request->has('Pis') && !empty($request->Pis)) {
            $Indexesmorphologiquespere->Pis = $request->Pis;
        };
        if ($request->has('Precision') && !empty($request->Precision)) {
            $Indexesmorphologiquespere->Precision = $request->Precision;
        };

        $Indexesmorphologiquespere->update([
            //  'ID'=>$Indexesmorphologiquespere->ID,
            'Devel' => $Indexesmorphologiquespere->Devel,
            'TypeBassin' => $Indexesmorphologiquespere->TypeBassin,
            'Membres' => $Indexesmorphologiquespere->Membres,
            'Pis' => $Indexesmorphologiquespere->Pis,
            'Precision' => $Indexesmorphologiquespere->Precision,

        ]);

        return new IndexesmorphologiquesperesResource($Indexesmorphologiquespere);
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
        $Indexesmorphologiquespere = Indexesmorphologiquespere::findOrFail($id);
        $Indexesmorphologiquespere->forceDelete();
        return response()->json(['msg' => 'Indexesmorphologiquespere Deleted']);
    }
}
