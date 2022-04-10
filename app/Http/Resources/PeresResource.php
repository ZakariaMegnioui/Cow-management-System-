<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeresResource extends JsonResource
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
            'N' => $this->N,
            'Nom' => $this->Nom,
            'Datenaissance' => $this->Datenaissance,
            'Race' => $this->Race,
            'sujets' => $this->sujets,
            'sujet_id' => $this->sujet_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id

        ];
    }
}
