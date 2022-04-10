<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexfonctionnelsperesResource extends JsonResource
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
            'SCS'=>$this->SCS,
            'LONG'=>$this->LONG,
            'FERT'=>$this->FERT,
            'FN'=>$this->FN,
            'FV'=>$this->FV,
            'Precision'=>$this->Precision,
            'pere_id'=>$this->pere_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'user_id'=>$this->user_id,
        ];
    }
}
