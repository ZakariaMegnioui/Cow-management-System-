<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexeslaitiersperesResource extends JsonResource
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
            'Lait'  => $this->Lait,
            'MG' => $this->MG,
            'MGkg'  => $this->MGkg,
            'Prot'  => $this->Prot,
            'ProtKg'  => $this->ProtKg,
            'Precision'  => $this->Precision,
            'pere_id'  => $this->pere_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'user_id'  => $this->user_id,
        ];
    }
}
