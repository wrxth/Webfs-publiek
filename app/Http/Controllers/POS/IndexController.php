<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\OrderItem;
use App\Models\RiceOption;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $categories = MenuCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        $riceOptions = RiceOption::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'extra_price']);

        $noteSuggestions = OrderItem::query()
            ->select('note', DB::raw('COUNT(*) as usage_count'))
            ->whereNotNull('note')
            ->where('note', '<>', '')
            ->groupBy('note')
            ->orderByDesc('usage_count')
            ->orderBy('note')
            ->limit(10)
            ->get()
            ->map(fn (OrderItem $item) => [
                'note' => $item->note,
                'usage_count' => (int) $item->usage_count,
            ])
            ->all();

        return view('pos.index', [
            'categories' => $categories,
            'riceOptions' => $riceOptions,
            'noteSuggestions' => $noteSuggestions,
        ]);
    }
}
