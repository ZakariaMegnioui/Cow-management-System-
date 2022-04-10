<?php

namespace App\Http\Controllers;

use App\Http\Resources\GrandperepaternelsCollection;
use App\Http\Resources\GrandperepaternelsResource;
use App\Models\Grandperepaternel;
use Illuminate\Http\Request;

class GrandperepaternelsController extends Controller
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
                $Grandperepaternels = Grandperepaternel::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new GrandperepaternelsCollection($Grandperepaternels);
            } else {
                $Grandperepaternels = Grandperepaternel::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new GrandperepaternelsCollection($Grandperepaternels);
            }
        } else {
            $Grandperepaternels = Grandperepaternel::all();
            return new GrandperepaternelsCollection($Grandperepaternels);
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
            'N' => 'nullable|Max:45',
            'Nom' => 'nullable|Max:45',
            'DateNaissance' => 'Nullable|Date',
            'Race' => 'nullable|Max:30',
        ]);
        $ExGPP = Grandperepaternel::where('N', $request->N)->withTrashed()->first();
        if (!empty($ExGPP)) {
            return response()->json([
                'Msg' => "Grandperepaternel Exist Deja ",
                'Grandperepaternel' => $ExGPP,
            ]);
        } elseif (empty($ExGPP) && $request->search !== true) {
            $Grandperepaternel = Grandperepaternel::create([

                'id' => Grandperepaternel::max('id') + 1,
                'N' => $request->N,
                'Nom' => $request->Nom,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'user_id' => auth()->user()->id,
            ]);

            return new GrandperepaternelsResource($Grandperepaternel);
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
        $Grandperepaternel = Grandperepaternel::findOrFail($id);
        return new GrandperepaternelsResource($Grandperepaternel);
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
        $Grandperepaternel = Grandperepaternel::findOrFail($id);
        $request->validate([
            'N' => 'Max:45',
            'Nom' => 'Max:45',
            'DateNaissance' => 'Nullable|Date',
            'Race' => 'Max:30',

        ]);

        if ($request->has('N') && !empty($request->N)) {
            $Grandperepaternel->N = $request->N;
        }
        if ($request->has('Nom') && !empty($request->Nom)) {
            $Grandperepaternel->Nom = $request->Nom;
        }
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Grandperepaternel->DateNaissance = $request->DateNaissance;
        }
        if ($request->has('Race') && !empty($request->Race)) {
            $Grandperepaternel->Race = $request->Race;
        }
        if ($request->has('sujet_id') && !empty($request->sujet_id)) {
            $Grandperepaternel->sujet_id = $request->sujet_id;
        }
        if ($request->has('user_id') && !empty($request->user_id)) {
            $Grandperepaternel->user_id = $request->user_id;
        };
        $Grandperepaternel->update([
            'id' => $Grandperepaternel->id,
            'N' => $Grandperepaternel->N,
            'Nom' => $Grandperepaternel->Nom,
            'DateNaissance' => $Grandperepaternel->DateNaissance,
            'Race' => $Grandperepaternel->Race,
            'sujet_id' => $Grandperepaternel->sujet_id,
            'user_id' => $Grandperepaternel->user_id,

        ]);

        return new GrandperepaternelsResource($Grandperepaternel);
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
        $Grandperepaternel = Grandperepaternel::findOrFail($id);
        $Grandperepaternel->delete();
        return response()->json(['msg' => 'Grandperepaternel Deleted']);
    }
}
