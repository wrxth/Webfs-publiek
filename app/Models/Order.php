<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['order_number', 'table_session_id', 'type', 'status', 'round_number', 'customer_name', 'customer_phone', 'customer_address', 'customer_postcode', 'customer_city', 'delivery_fee', 'notes', 'subtotal', 'discount_total', 'total', 'ordered_at'];
    protected $casts = ['subtotal' => 'decimal:2', 'discount_total' => 'decimal:2', 'total' => 'decimal:2', 'delivery_fee' => 'decimal:2', 'ordered_at' => 'datetime'];

    public function tableSession(): BelongsTo { return $this->belongsTo(TableSession::class); }
    public function items(): HasMany { return $this->hasMany(OrderItem::class); }
    public function review(): HasOne { return $this->hasOne(Review::class); }

    public function recalculate(): void
    {
        $subtotal = $this->items()->sum('line_total');
        $this->update(['subtotal' => $subtotal, 'total' => $subtotal + $this->delivery_fee - $this->discount_total]);
    }
}
