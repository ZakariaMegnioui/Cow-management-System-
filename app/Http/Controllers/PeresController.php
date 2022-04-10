<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeresCollection;
use App\Http\Resources\PeresResource;
use App\Models\Pere;
use Illuminate\Http\Request;

class PeresController extends Controller
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
                $Peres = Pere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new PeresCollection($Peres);
            } else {
                $Peres = Pere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new PeresCollection($Peres);
            }
        } else {
            $Peres = Pere::all();
            return new PeresCollection($Peres);
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
            'N' => 'nullable|Max:17',
            'Nom' => 'nullable|Max:27',
            'Datenaissance' => 'Nullable|Date',
            'Race' => 'nullable|Max:12',
        ]);
        $ExPere = Pere::where('N', $request->N)->withTrashed()->first();
        if (!empty($ExPere)) {
            return response()->json([
                'Msg' => "Pere Exist Deja ",
                'Pere' => $ExPere,
            ]);
        } elseif (empty($ExPere) && $request->search !== true) {
            $Pere = Pere::create([
                 'id' => Pere::max('id') + 1,
                'N' => $request->N,
                'Nom' => $request->Nom,
                'Datenaissance' => $request->Datenaissance,
                'Race' => $request->Race,
                'user_id' => auth()->user()->id,
            ]);
            return new PeresResource($Pere);
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
        $Pere = Pere::where('N', $id)->first();
        return new PeresResource($Pere);
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
        $Pere = Pere::findOrFail($id);
        $request->validate([
            'N' => 'Max:17',
            'Nom' => 'Max:27',
            'Datenaissance' => 'Nullable|Date',
            'Race' => 'Max:12',
        ]);

        if ($request->has('N') && !empty($request->N)) {
            $Pere->N = $request->N;
        };
        if ($request->has('Nom') && !empty($request->Nom)) {
            $Pere->Nom = $request->Nom;
        };
        if ($request->has('Datenaissance') && !empty($request->Datenaissance)) {
            $Pere->Datenaissance = $request->Datenaissance;
        };
        if ($request->has('Race') && !empty($request->Race)) {
            $Pere->Race = $request->Race;
        };


        $Pere->update([

            'NSNIT' => $Pere->NSNIT,
            'Nom' => $Pere->Nom,
            'Datenaissance' => $Pere->Datenaissance,
            'Race' => $Pere->Race,

        ]);
        return new PeresResource($Pere);
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
        $Pere = Pere::findOrFail($id);
        $Pere->delete();
        return response()->json(['msg' => 'Pere Deleted']);
    }
}
