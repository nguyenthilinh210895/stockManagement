<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $table = 'qualitys';
    
    protected $fillable = [
        'id',
        'quality_name ',   
        'quality_code',
    ];

    public $timestamps = false;

    public function products()
    {
    return $this->belongsTo('App\Models\Product');
    }
}
