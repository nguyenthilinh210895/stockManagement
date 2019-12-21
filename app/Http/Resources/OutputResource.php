<?php

namespace App\Http\Resources;

use App\Models\DetailOutputWare;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DetailOutputResource  as DetailOutputResource ;


class OutputResource extends JsonResource
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
            'output_code' => $this->output_code,
            'output_content' => $this->output_content,
            'output_date' => $this->output_date,
            'output_total_money' => $this->output_total_money,
            'status' =>$this->status,
            'user_id' => $this->user_id,
            'employee' =>User::where('id',$this->user_id)->first(),
            'detail' => $this->detail_output_wares->map(function ($detail){return new DetailOutputResource($detail);}),
        ];
    }
}
