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
        'output_date',
        'user_id',
        'output_content',
        'zone_id',

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
