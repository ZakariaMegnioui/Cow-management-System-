<?php

namespace App\Http\Controllers;

use App\Http\Resources\GrandmerematernellesCollection;
use App\Http\Resources\GrandmerematernellesResource;
use App\Models\Grandmerematernelle;
use Illuminate\Http\Request;

class GrandmerematernellesController extends Controller
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
                $Grandmerematernelles = Grandmerematernelle::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new GrandmerematernellesCollection($Grandmerematernelles);
            } else {
                $Grandmerematernelles = Grandmerematernelle::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new GrandmerematernellesCollection($Grandmerematernelles);
            }
        } else {
            $Grandmerematernelles = Grandmerematernelle::all();
            return new GrandmerematernellesCollection($Grandmerematernelles);
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
            'NSNIT' => 'nullable|Max:16',
            'DateNaissance' => 'nullable|Date',
            'Race' => 'Max:12',
        ]);
        $ExGMM = Grandmerematernelle::where('NSNIT', $request->NSNIT)->withTrashed()->first();
        if (!empty($ExGMM)) {
            return response()->json([
                'Msg' => "GMM Exist Deja ",
                'Grandmerematernelle' => $ExGMM,
            ]);
        } elseif (empty($ExGMM) && $request->search !== true) {
            $Grandmerematernelle = Grandmerematernelle::create([
                'id' => Grandmerematernelle::max('id') + 1,
                'NSNIT' => $request->NSNIT,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'user_id' => auth()->user()->id,
            ]);

            return new GrandmerematernellesResource($Grandmerematernelle);
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
        $Grandmerematernelle = Grandmerematernelle::findOrFail($id);
        return new GrandmerematernellesResource($Grandmerematernelle);
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
        $Grandmerematernelle = Grandmerematernelle::findOrFail($id);
        $request->validate([
            'NSNIT' => 'Max:16',
            'DateNaissance' => 'Nullable|Date',
            'Race' => 'Max:12',

        ]);

        if ($request->has('NSNIT') && !empty($request->NSNIT)) {
            $Grandmerematernelle->NSNIT = $request->NSNIT;
        }
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Grandmerematernelle->DateNaissance = $request->DateNaissance;
        }
        if ($request->has('Race') && !empty($request->Race)) {
            $Grandmerematernelle->Race = $request->Race;
        }
        if ($request->has('sujet_id') && !empty($request->sujet_id)) {
            $Grandmerematernelle->sujet_id = $request->sujet_id;
        }
        if ($request->has('user_id') && !empty($request->user_id)) {
            $Grandmerematernelle->user_id = $request->user_id;
        };
        $Grandmerematernelle->update([
            'id' => $Grandmerematernelle->id,
            'NSNIT' => $Grandmerematernelle->NSNIT,
            'DateNaissance' => $Grandmerematernelle->DateNaissance,
            'Race' => $Grandmerematernelle->Race,
            'sujet_id' => $Grandmerematernelle->sujet_id,
            'user_id' => $Grandmerematernelle->user_id,

        ]);

        return new GrandmerematernellesResource($Grandmerematernelle);
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
        $Grandmerematernelle = Grandmerematernelle::findOrFail($id);
        $Grandmerematernelle->delete();
        return response()->json(['msg' => 'Grandmerematernelle Deleted']);
    }
}
