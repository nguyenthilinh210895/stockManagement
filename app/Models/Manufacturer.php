<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    
    protected $fillable = [
        'id',
        'name',   
        'address',
        'phone',
        'fax',
        'email',
    ];

    public $timestamps = false;

    public function products()
    {
    return $this->hasMany('App\Models\Product');
    }
}
