<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'menu_item_id', 'rice_option_id', 'quantity', 'unit_price', 'rice_extra_price', 'discount', 'note', 'line_total'];
    protected $casts = ['unit_price' => 'decimal:2', 'rice_extra_price' => 'decimal:2', 'discount' => 'decimal:2', 'line_total' => 'decimal:2'];

    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
    public function menuItem(): BelongsTo { return $this->belongsTo(MenuItem::class); }
    public function riceOption(): BelongsTo { return $this->belongsTo(RiceOption::class); }
}
