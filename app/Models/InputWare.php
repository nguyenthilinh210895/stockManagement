<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputWare extends Model
{
    protected $table = 'input_wares';

    protected $fillable = [
        'id',
        'input_code ',
        'input_content',
        'input_date',
        'input_total_money',
    ];

    public $timestamps = false;

    public function detail_input_wares()
    {
    return $this->hasOne('App\Models\DetailInputWare');
    }
}
