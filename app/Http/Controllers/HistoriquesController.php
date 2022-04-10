<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoriquesCollection;
use App\Http\Resources\HistoriquesResource;
use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!empty($request->search) || !empty($request->dateD && $request->dateF) ){

            if(!empty($request->dateD) && !empty($request->dateF)){
                $dateDebut=date("Y-m-d H:i:s",strtotime($request->dateD.'00:00:00'));
                $DateFin=date("Y-m-d H:i:s",strtotime($request->dateF.'23:59:59'));
                $Grandperepaternels=Historique::whereBetween('created_at',[$dateDebut,$DateFin])->get() ;
                return new HistoriquesCollection($Grandperepaternels);

            }else{
                $Historiques=Historique::Where('user_id','like',"%{$request->search}%")->orWhere('id','like',"%{$request->search}%")->get() ;
                return new HistoriquesCollection($Historiques);
            }

        }else{
            $Historiques=Historique::all();
            return new HistoriquesCollection($Historiques);
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
            'table'=>'nullable|Max:70',
            'user_id'=>'required',
        ]);

        $Historique=Historique::create([
            'table'=>$request->table,
            'user_id'=>$request->user_id,
        ]);
        return new HistoriquesResource($Historique);
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
        $Historique= Historique::findOrFail($id);
        return new HistoriquesResource($Historique);
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
        $Historique= Historique::findOrFail($id);
        $request->validate([
            'table'=>'Max:70',
        ]);
        if($request->has('table') && !empty($request->table)){
            $Historique->table= $request->table;
        };
        if($request->has('user_id') && !empty($request->user_id)){
            $Historique->user_id= $request->user_id;
        };
        $Historique->update([
            'table'=>$Historique->table,
            'user_id'=>$Historique->user_id,
        ]);
        return new HistoriquesResource($Historique);
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
        $Historique= Historique::findOrFail($id);
        $Historique->delete();
        return response()->json(['msg'=>'Historique Deleted']);
    }
}
