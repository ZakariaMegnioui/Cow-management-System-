<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeresCollection;
use App\Http\Resources\MeresResource;
use App\Models\Mere;
use Illuminate\Http\Request;

class MeresController extends Controller
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
                $Meres = Mere::whereBetween('created_at', [$dateDebut, $DateFin])->get();
                return new MeresCollection($Meres);
            } else {
                $Meres = Mere::where('sujet_id', 'like', "%{$request->search}%")->orWhere('user_id', 'like', "%{$request->search}%")->orWhere('id', 'like', "%{$request->search}%")->get();
                return new MeresCollection($Meres);
            }
        } else {
            $Meres = Mere::all();
            return new MeresCollection($Meres);
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
            'NSNIT' => 'Max:16',
            'DateNaissance' => 'Nullable|Date',
            'Race' => 'Max:12',


        ]);
        $ExMere = Mere::where('NSNIT', $request->NSNIT)->withTrashed()->first();
        if (!empty($ExMere)) {
            return response()->json([
                'Msg' => "Mere Exist Deja ",
                'Mere' => $ExMere,
            ]);
        } elseif (empty($ExMere) && $request->search !== true) {
            $Mere = Mere::create([
                'id' => Mere::max('id') + 1,
                'NSNIT' => $request->NSNIT,
                'DateNaissance' => $request->DateNaissance,
                'Race' => $request->Race,
                'user_id' => auth()->user()->id,
            ]);

            return new MeresResource($Mere);
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
        $Mere = Mere::findOrFail($id);
        return new MeresResource($Mere);
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
        $Mere = Mere::findOrFail($id);

        $request->validate([
            'NSNIT' => 'Max:16',
            'DateNaissance' => 'Date',
            'Race' => 'Max:12',


        ]);

        if ($request->has('NSNIT') && !empty($request->NSNIT)) {
            $Mere->NSNIT = $request->NSNIT;
        };
        if ($request->has('DateNaissance') && !empty($request->DateNaissance)) {
            $Mere->DateNaissance = $request->DateNaissance;
        };
        if ($request->has('Race') && !empty($request->Race)) {
            $Mere->Race = $request->Race;
        };
        if ($request->has('sujet_id') && !empty($request->sujet_id)) {
            $Mere->sujet_id = $request->sujet_id;
        };
        if ($request->has('user_id') && !empty($request->user_id)) {
            $Mere->user_id = $request->user_id;
        };
        $Mere->update([
            'id' => $Mere->id,
            'NSNIT' => $Mere->NSNIT,
            'DateNaissance' => $Mere->DateNaissance,
            'Race' => $Mere->Race,
            'sujet_id' => $Mere->sujet_id,
            'user_id' => $Mere->user_id,
        ]);
        return new MeresResource($Mere);
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
        $Mere = Mere::findOrFail($id);
        $Mere->delete();
        return response()->json(['msg' => 'Mere Deleted']);
    }
}
