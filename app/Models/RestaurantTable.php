<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantTable extends Model
{
    protected $fillable = ['code', 'seats', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function sessions(): HasMany { return $this->hasMany(TableSession::class); }
}
