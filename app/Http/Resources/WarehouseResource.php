<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
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
            'warehouse_name' => $this->warehouse_name,
            'ware_manage' => $this->ware_manage,
            'ware_phone' => $this->ware_phone,
            'ware_email' => $this->ware_email,
            'area_id' => $this->area_id,
        ];
    }
}
