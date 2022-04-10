<?php

namespace App\Http\Controllers;

use App\Http\Resources\GrandperematernelsCollection;
use App\Http\Resources\GrandperematernelsResource;
use App\Models\Grandperematernel;
use Illuminate\Http\Request;

class GrandperematernelsController extends Controller
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
                $Grandperematernels = Grandperematernel::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new GrandperematernelsCollection($Grandperematernels);
            } else {
                $Grandperematernels = Grandperematernel::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new GrandperematernelsCollection($Grandperematernels);
            }
        } else {
            $Grandperematernels = Grandperematernel::all();
            return new GrandperematernelsCollection($Grandperematernels);
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
            /* 'N' => 'Max:17',
            'Nom' => 'Max:27',
            'DateNaissance' => 'Date',
            'Race' => 'Max:8',*/]);
        $ExGPM = Grandperematernel::where('N', $request->N)->withTrashed()->first();
        if (!empty($ExGPM)) {
            return response()->json([
                'Msg' => "Pere Exist Deja ",
                'Grandperematernel' => $ExGPM,
            ]);
        } elseif (empty($ExGPM) && $request->search !== true) {
            $Grandperematernel = Grandperematernel::create([
                'id' => Grandperematernel::max('id') + 1,
                'N' => $request->N,
                'Nom' => $request->Nom,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'user_id' => auth()->user()->id,
            ]);

            return new GrandperematernelsResource($Grandperematernel);
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
        $Grandperematernel = Grandperematernel::findOrFail($id);
        return new GrandperematernelsResource($Grandperematernel);
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
        $Grandperematernel = Grandperematernel::findOrFail($id);
        $request->validate([
            'N' => 'Max:17',
            'Nom' => 'Max:27',
            'DateNaissance' => 'Nullable|Date',
            'Race' => '  Max:8',

        ]);

        if ($request->has('N') && !empty($request->N)) {
            $Grandperematernel->N = $request->N;
        }
        if ($request->has('Nom') && !empty($request->Nom)) {
            $Grandperematernel->Nom = $request->Nom;
        }
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Grandperematernel->DateNaissance = $request->DateNaissance;
        }
        if ($request->has('Race') && !empty($request->Race)) {
            $Grandperematernel->Race = $request->Race;
        }
        if ($request->has('sujet_id') && !empty($request->sujet_id)) {
            $Grandperematernel->Sujet_ID = $request->sujet_id;
        }
        if ($request->has('compte_id') && !empty($request->compte_id)) {
            $Grandperematernel->compte_id = $request->compte_id;
        };
        $Grandperematernel->update([
            'id' => $Grandperematernel->id,
            'N' => $Grandperematernel->N,
            'Nom' => $Grandperematernel->Nom,
            'DateNaissance' => $Grandperematernel->DateNaissance,
            'Race' => $Grandperematernel->Race,
            'Sujet_ID' => $Grandperematernel->Sujet_ID,
            'compte_id' => $Grandperematernel->compte_id,

        ]);

        return new GrandperematernelsResource($Grandperematernel);
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
        $Grandperematernel = Grandperematernel::findOrFail($id);
        $Grandperematernel->delete();
        return response()->json(['msg' => 'Grandperematernel Deleted']);
    }
}
