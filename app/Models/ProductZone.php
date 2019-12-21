<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductZone extends Model
{
    protected $table = 'product_zone';

    protected $fillable = [
        'id',
        'product_id',
        'quantity_input',
        'quantity_output',
        'quantity_stock',
        'zone-id',
    ];
    public $timestamps = false;
}
