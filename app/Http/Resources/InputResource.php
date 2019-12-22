<?php

namespace App\Http\Resources;

use App\Models\DetailInputWare;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DetailInputResource as DetailInputResource;

class InputResource extends JsonResource
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
            'input_code' => $this->input_code,
            'input_content' => $this->input_content,
            'input_date' => $this->input_date,
            'input_total_money' => $this->input_total_money,
            'status' =>$this->status,
            'employee' => $this->user_id,
            'getEmployee' =>User::where('id',$this->user_id)->first(),
            'detail' => $this->detail_input_wares->map(function ($detail){return new DetailInputResource($detail);}),
        ];
    }

}
