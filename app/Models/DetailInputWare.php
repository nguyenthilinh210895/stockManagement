<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailInputWare extends Model
{
    protected $table = 'detail_input_wares';

    protected $fillable = [
        'id',
        'detail_input_quantity',
        'detail_input_amount',
        'input_date',
        'user_id',
        'input_content',
        'zone_id',
    ];

    public $timestamps = true;

    public function input_wares()
    {
        return $this->belongsTo('App\Models\InputWare');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
