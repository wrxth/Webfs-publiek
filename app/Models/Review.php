<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = ['order_id', 'rating_food', 'rating_service', 'rating_speed', 'comment'];
    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
}
