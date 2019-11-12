<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compartment extends Model
{
    protected $table = 'warehouses';
    
    protected $fillable = [
        'id',
       'zone_code', 
       'attribue ', 
       'item_group_id',
    ];

    public $timestamps = false;
    
    public function warehoues()
    {
    return $this->belongsTo('App\Models\Warehouse');
    }
    public function item_groups()
    {
    return $this->hasMany('App\Models\ItemGroup');
    }
    
}
