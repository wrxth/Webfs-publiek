<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model
{
    protected $fillable = ['title', 'description', 'discount_type', 'discount_value', 'starts_at', 'ends_at', 'is_active'];
    protected $casts = ['discount_value' => 'decimal:2', 'starts_at' => 'date', 'ends_at' => 'date', 'is_active' => 'boolean'];

    public function menuItems(): BelongsToMany { return $this->belongsToMany(MenuItem::class); }

    public function scopeCurrent(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->whereDate('starts_at', '<=', today())
            ->whereDate('ends_at', '>=', today());
    }

    public function discountLabel(): string
    {
        return match ($this->discount_type) {
            'fixed_price' => 'Vaste prijs: EUR ' . number_format((float) $this->discount_value, 2, ',', '.'),
            'amount_off' => 'Korting: EUR ' . number_format((float) $this->discount_value, 2, ',', '.'),
            'percentage' => 'Korting: ' . number_format((float) $this->discount_value, 0, ',', '.') . '%',
            default => (string) $this->discount_value,
        };
    }
}
