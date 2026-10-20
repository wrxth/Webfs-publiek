<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiceOption extends Model
{
    protected $fillable = ['name', 'extra_price', 'sort_order', 'is_active'];
    protected $casts = ['extra_price' => 'decimal:2', 'is_active' => 'boolean'];
}
