<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quality_code' => $this->quality_code,
            'quality_name' => $this->quality_name,
        ];
    }
}
