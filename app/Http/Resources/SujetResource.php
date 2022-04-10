<?php

namespace App\Http\Resources;

use App\Laravue\Models\User;
use App\Models\Mere;
use Illuminate\Http\Resources\Json\JsonResource;

class SujetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'NSNIT' => $this->NSNIT,
            'DateNaissance' => $this->DateNaissance,
            'Race' => $this->Race,
            'NTravail' => $this->NTravail,
            'user_id' => $this->user_id,
            'Adresse' => $this->Adresse,
            'Sexe' => $this->Sexe,
            'Type' => $this->Type,
            'Etat' => $this->Etat,
             'mere_id' => $this->meres_ID,
            'pere_id' => $this->peres_ID,
            'eleveurnaisseur' => $this->eleveurnaisseur,
            'eleveurproprietaire' => $this->eleveurproprietaire,
            'mere' => $this->mere,
            'pere' => $this->pere,
             'image1'=>$this->image1,
             'image2'=>$this->image2,
             'cartGrize'=>$this->cartGrize,
            'user' => $this->user,
            'Grandperepaternel' => $this->Grandperepaternel,
            'Grandmerepaternel' => $this->Grandmerepaternelle,
            'Grandperematernel'=>$this->Grandperematernel,
            'Grandmerematernelle'=>$this->Grandmerematernelle,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
