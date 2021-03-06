<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'product_name',
        'product_code',
        'product_price',
        'out_of_date',
    ];

    public $timestamps = false;

    public function input_wares()
    {
    return $this->belongsToMany('App\Models\InputWare');
    }

    public function output_wares()
    {
    return $this->belongsToMany('App\Models\OutputWare');
    }

    public function item_groups()
    {
    return $this->belongsTo('App\Models\ItemGroup');
    }

    public function manufacturers()
    {
    return $this->belongsTo('App\Models\Manufacturer');
    }

    public function qualities()
    {
        return $this->hasMany('App\Models\Quality');
    }
    public function zones()
    {
        return $this->belongsToMany('App\Models\Zone');
    }
    public function calculation_units()
    {
    return $this->hasMany('App\Models\CalculationUnit');
    }

}
