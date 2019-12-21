<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutputWare extends Model
{
    protected $table = 'output_wares';

    protected $fillable = [
        'id',
        'output_code ',
        'output_content',
        'output_date',
        'output_total_money',
        'status',
    ];

    public $timestamps = true;

    public function detail_output_wares()
    {
    return $this->hasMany('App\Models\DetailOutputWare','outputWare_id');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','inputWare_id');
    }
}
