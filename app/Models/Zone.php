<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = 'zones';

    protected $fillable = [
        'id',
       'zone_code',
       'attribute ',
    ];

    public $timestamps = false;

    public function warehoues()
    {
    return $this->belongsTo('App\Models\Warehouse');
    }
    public function item_groups()
    {
    return $this->belongsToMany('App\Models\ItemGroup');
    }

}
