<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductionlaitieregrandmerematernellesResource extends JsonResource
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
            'id'=>$this->id,
            'N_LACT'=>$this->N_LACT,
            'Age_V_lage'=>$this->Age_V_lage,
            'Kg_Lait'=>$this->Kg_Lait,
            'MG'=>$this->MG,
            'KgMG'=>$this->KgMG,
            'Prot'=>$this->Prot,
            'KgProt'=>$this->KgProt,
            'GMMaternelle_Id'=>$this->GMMaternelle_Id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'user_id'=>$this->user_id,
        ];
    }
}
