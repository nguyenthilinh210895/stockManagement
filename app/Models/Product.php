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

    public $timestamps = true;

    public function detail_input_wares()
    {
    return $this->belongsTo('App\Models\DetailInputWare');
    }

    public function detail_output_wares()
    {
    return $this->belongsTo('App\Models\DetailOutputWare');
    }

    public function item_groups()
    {
    return $this->belongsTo('App\Models\ItemGroup');
    }

    public function manufacturers()
    {
    return $this->belongsTo('App\Models\Manufacturer');
    }

    public function qualitys()
    {
    return $this->hasMany('App\Models\Quality');
    }

    public function calculation_units()
    {
    return $this->hasMany('App\Models\CalculationUnit');
    }
    
}
