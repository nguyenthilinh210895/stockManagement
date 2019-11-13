<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ZoneResource as ZoneResource;

class ItemGroupResource extends JsonResource
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
            'group_name' => $this->group_name,
            'group_code' => $this->group_code,
            'zone' => $this->zones->map(function ($zone){return new ZoneResource($zone);}),
        ];
    }
}
