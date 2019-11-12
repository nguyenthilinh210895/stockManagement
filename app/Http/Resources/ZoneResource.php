<?php

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
            'warehouse_id' => $this->warehouse_id,
            'zone_code' => $this->zone_code,
            'attribute' => $this->attribute,
            'warehouse_name' => Warehouse::where('id',$this->warehouse_id)->pluck('warehouse_name'),
        ];
    }
}
