<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource as ProductResource;

class DetailInputResource extends JsonResource
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
            'detail_input_quantity' => $this->detail_input_quantity,
            'detail_estimate_quantity' => $this->detail_estimate_quantity,
            'detail_input_amount' => $this->detail_input_amount,
            'product_id' => $this->product_id,
            'inputWare_id' => $this->inputWare_id,
            //'products' => Product::where('id',$this->product_id)->first(),
            'product' => $this->getProduct($this->product_id),
        ];
    }
    public function getProduct($id){
        return (new ProductResource(Product::find($id)));
    }
}
