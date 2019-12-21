<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductResource as ProductResource;
use App\Models\Product;
use App\Models\Zone;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailOutputResource extends JsonResource
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
            'detail_output_quantity' => $this->detail_output_quantity,
            'detail_estimate_quantity' => $this->detail_estimate_quantity,
            'detail_output_amount' => $this->detail_output_amount,
            'product_id' => $this->product_id,
            'outputWare_id' => $this->outputWare_id,
//            'zone' => Zone::where('id',$this->zone_id)->first(),
            //'products' => Product::where('id',$this->product_id)->first(),
            'product' => $this->getProduct($this->product_id),
        ];
    }
    public function getProduct($id){
        return (new ProductResource(Product::find($id)));
    }
}
