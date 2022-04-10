<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EleveurproprietairesResource extends JsonResource
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
            'Nom'=>$this->Nom,
            'Prenom'=>$this->Prenom,
            'Adresse'=>$this->Adresse,
            'CIN'=>$this->CIN,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'user_id'=>$this->user_id,
        ];
    }
}
