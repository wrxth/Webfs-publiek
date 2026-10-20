<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(Request $request): View
    {
        $items = MenuItem::with('category')
            ->search($request->string('search')->toString())
            ->when($request->filled('category'), fn ($q) => $q->where('menu_category_id', $request->integer('category')))
            ->orderBy('number')
            ->orderBy('suffix')
            ->paginate(25);

        return view('admin.menu-items.index', [
            'items' => $items,
            'categories' => MenuCategory::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.menu-items.create', ['categories' => MenuCategory::orderBy('sort_order')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        MenuItem::create($this->validated($request));
        return redirect()->route('admin.menu-items.index')->with('success', 'Gerecht toegevoegd.');
    }

    public function edit(MenuItem $menuItem): View
    {
        return view('admin.menu-items.edit', ['menuItem' => $menuItem, 'categories' => MenuCategory::orderBy('sort_order')->get()]);
    }

    public function update(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $menuItem->update($this->validated($request));
        return redirect()->route('admin.menu-items.index')->with('success', 'Gerecht aangepast.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();
        return back()->with('success', 'Gerecht verwijderd.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'number' => ['nullable', 'integer', 'min:1'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}
