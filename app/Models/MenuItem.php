<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuItem extends Model
{
    protected $fillable = ['menu_category_id', 'number', 'suffix', 'name', 'description', 'price', 'image_path', 'is_active'];
    protected $casts = ['price' => 'decimal:2', 'is_active' => 'boolean'];

    public function category(): BelongsTo { return $this->belongsTo(MenuCategory::class, 'menu_category_id'); }
    public function offers(): BelongsToMany { return $this->belongsToMany(Offer::class); }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function (Builder $query, string $search) {
            $search = trim($search);

            $query->where(function (Builder $sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('suffix', 'like', "%{$search}%");

                if (preg_match('/^(\d+)\s*([a-z]*)$/i', $search, $matches)) {
                    $sub->orWhere(function (Builder $numberQuery) use ($matches) {
                        $numberQuery->where('number', (int) $matches[1]);

                        if ($matches[2] !== '') {
                            $numberQuery->where('suffix', 'like', $matches[2]);
                        }
                    });
                }
            });
        });
    }
}
