<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    
    protected $fillable = [
        'id', 
        'area_code',   
        'area_name',    
    ];

    public $timestamps = false;
    public function warehouses()
    {
        return $this->hasMany('App\Models\Warehouse');
    }
}
