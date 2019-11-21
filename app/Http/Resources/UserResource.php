<?php

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fullname' => $this->fullname,
            'address' => $this->address,
            'phone_number' =>$this->phone_number,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'employee_id' => $this->employee_id,
            'warehouse_id' => $this->warehouse_id,
            'warehouse_name' => Warehouse::where('id',$this->warehouse_id)->pluck('warehouse_name')[0],
        ];
    }
}
