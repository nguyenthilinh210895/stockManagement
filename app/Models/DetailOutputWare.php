<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOutputWare extends Model
{
    protected $table = 'detail_output_wares';
    
    protected $fillable = [
        'id',
        'detail_output_quantity',   
        'detail_output_amount',  
        'detail_output_quantity_fact',

    ];

    public $timestamps = true;
    
    public function output_wares()
    {
        return $this->belongsTo('App\Models\OutputWare');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
