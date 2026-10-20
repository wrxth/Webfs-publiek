<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $items = MenuItem::with('category')
            ->where('is_active', true)
            ->search($request->string('q')->toString())
            ->when($request->filled('category_id'), fn ($q) => $q->where('menu_category_id', $request->integer('category_id')))
            ->limit(30)
            ->get();

        return response()->json($items);
    }
}
