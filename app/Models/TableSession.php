<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableSession extends Model
{
    protected $fillable = ['restaurant_table_id', 'guest_count', 'guest_ages', 'deluxe_menu', 'status', 'closed_at'];
    protected $casts = ['guest_ages' => 'array', 'deluxe_menu' => 'boolean', 'closed_at' => 'datetime'];

    public function table(): BelongsTo { return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id'); }
    public function orders(): HasMany { return $this->hasMany(Order::class); }
    public function helpRequests(): HasMany { return $this->hasMany(HelpRequest::class); }
}
