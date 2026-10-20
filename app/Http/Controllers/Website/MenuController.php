<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $categories = MenuCategory::query()
            ->where('is_active', true)
            ->with(['items' => fn ($q) => $q->where('is_active', true)->search($request->string('search')->toString())])
            ->orderBy('sort_order')
            ->get();

        $allItems = \App\Models\MenuItem::query()
            ->where('is_active', true)
            ->with('category')
            ->orderBy('number')
            ->orderBy('suffix')
            ->get();

        $activeOffers = Offer::query()
            ->current()
            ->with('menuItems')
            ->orderBy('starts_at')
            ->get();

        return view('website.menu.index', compact('categories', 'allItems', 'activeOffers'));
    }
}
