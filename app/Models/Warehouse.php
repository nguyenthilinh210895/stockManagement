<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = [
       'warehouse_name ',
       'ware_manage',
       'ware_phone',
       'ware_email',
        'area_id',
    ];

    public $timestamps = false;

    public function areas()
    {
    return $this->belongsTo('App\Models\Area');
    }


    public function zones()
    {
    return $this->hasMany('App\Models\Zone');
    }

}
