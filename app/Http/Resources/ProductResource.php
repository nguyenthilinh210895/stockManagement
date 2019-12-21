<?php

namespace App\Http\Resources;

use App\Http\Resources\ZoneResource as ZoneResource;
use App\Models\CalculationUnit;
use App\Models\ItemGroup;
use App\Models\Manufacturer;
use App\Models\Quality;
use App\Models\Zone;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class ProductResource extends JsonResource
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
            'product_name' => $this->product_name,
            'product_code' => $this->product_code,
            'product_price' =>$this->product_price,
            'out_of_date' => $this->out_of_date,
            'zone' => $this->zones->map(function ($zone){return new ZoneResource($zone);}),
            'quality_id' => $this->quality_id,
            'quality' => Quality::where('id',$this->quality_id)->pluck('quality_name')[0],
            'calculation_unit_id' => $this->calculation_unit_id,
            'unit' => CalculationUnit::where('id',$this->calculation_unit_id)->pluck('unit_name')[0],
            'item_group_id' => $this->item_group_id,
            'group' =>ItemGroup::where('id',$this->item_group_id)->pluck('group_name')[0],
            'manufacturer_id' =>  $this->manufacturer_id,
            'manufacturer' => Manufacturer::where('id',$this->manufacturer_id)->pluck('name')[0],
        ];
    }
}
