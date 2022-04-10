<?php

namespace App\Http\Controllers;

use App\Http\Resources\GrandmerepaternellesCollection;
use App\Http\Resources\GrandmerepaternellesResource;
use Illuminate\Http\Request;
use App\Models\Grandmerepaternelle;

class GrandmerepaternellesController extends Controller
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
                $Grandmerepaternelles = Grandmerepaternelle::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new GrandmerepaternellesCollection($Grandmerepaternelles);
            } else {
                $Grandmerepaternelles = Grandmerepaternelle::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new GrandmerepaternellesCollection($Grandmerepaternelles);
            }
        } else {
            $Grandmerepaternelles = Grandmerepaternelle::all();
            return new GrandmerepaternellesCollection($Grandmerepaternelles);
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
            'N' => 'Max:45',
            'DateNaissance' => 'Date',
            'Race' => 'Max:45',
        ]);
        $ExGMP = Grandmerepaternelle::where('N', $request->N)->withTrashed()->first();
        if (!empty($ExGMP)) {
            return response()->json([
                'Msg' => "Grandmerepaternelle Exist Deja ",
                'Grandmerepaternelle' => $ExGMP,
            ]);
        } elseif (empty($ExGMP) && $request->search !== true) {
            $Grandmerepaternelle = Grandmerepaternelle::create([
                'id' => Grandmerepaternelle::max('id') + 1,
                'N' => $request->N,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'user_id' =>1,
            ]);

            return new GrandmerepaternellesResource($Grandmerepaternelle);
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
        $Grandmerepaternelle = Grandmerepaternelle::findOrFail($id);
        return new GrandmerepaternellesResource($Grandmerepaternelle);
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
        $Grandmerepaternelle = Grandmerepaternelle::findOrFail($id);
        $request->validate([
            'N' => 'Max:45',
            'DateNaissance' => 'Nullable|Date',
            'Race' => 'Max:45',

        ]);
        if ($request->has('N') && !empty($request->N)) {
            $Grandmerepaternelle->N = $request->N;
        }
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Grandmerepaternelle->DateNaissance = $request->DateNaissance;
        }
        if ($request->has('Race') && !empty($request->Race)) {
            $Grandmerepaternelle->Race = $request->Race;
        }
        if ($request->has('sujet_id') && !empty($request->sujet_id)) {
            $Grandmerepaternelle->sujet_id = $request->sujet_id;
        }
        if ($request->has('user_id') && !empty($request->user_id)) {
            $Grandmerepaternelle->user_id = $request->user_id;
        };
        $Grandmerepaternelle->update([
            'id' => $Grandmerepaternelle->id,
            'N' => $Grandmerepaternelle->N,
            'DateNaissance' => $Grandmerepaternelle->DateNaissance,
            'Race' => $Grandmerepaternelle->Race,
            'sujet_id' => $Grandmerepaternelle->sujet_id,
            'user_id' => $Grandmerepaternelle->user_id,

        ]);

        return new GrandmerepaternellesResource($Grandmerepaternelle);
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
        $Grandmerepaternelle = Grandmerepaternelle::findOrFail($id);
        $Grandmerepaternelle->delete();
        return response()->json(['msg' => 'Grandmerepaternelle Deleted']);
    }
}
