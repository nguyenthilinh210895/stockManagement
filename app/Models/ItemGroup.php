<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table = 'item_groups';

    protected $fillable = [
        'id',
        'group_code',
        'group_name',
    ];

    public $timestamps = false;

    public function zones()
    {
    return $this->belongsToMany('App\Models\Zone');
    }

    public function products()
    {
    return $this->hasMany('App\Models\Product');
    }
}
