<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'input_total_money' => $this->total_money,
        ];
    }
}
