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
    ];

    public $timestamps = true;

    public function detail_output_wares()
    {
    return $this->hasOne('App\Models\DetailOutputWare');
    }
}
