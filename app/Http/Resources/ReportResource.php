<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'date' => $this->date,
            'angler' => $this->angler->firstName . ' ' . $this->angler->lastName,
            'specimen' => $this->specimen->name,
            'lbs' => $this->lbs,
            'oz' => $this->oz,
            'sideone' => $this->sideone,
            'sidetwo' => $this->sidetwo,
            'notes' => $this->notes,
            
        ];
    }
}
