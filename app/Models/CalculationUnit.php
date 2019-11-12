<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculationUnit extends Model
{
    protected $table = 'calculation_units';
    
    protected $fillable = [
        'id',
        'unit_name ',      
    ];
    public $timestamps = false;
}
