<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        return view('admin.offers.index', ['offers' => Offer::with('menuItems')->latest()->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.offers.create', [
            'offer' => new Offer([
                'discount_type' => 'fixed_price',
                'starts_at' => now()->toDateString(),
                'ends_at' => now()->addWeek()->toDateString(),
                'is_active' => true,
            ]),
            'menuItems' => $this->menuItems(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $offer = Offer::create($data);
        $offer->menuItems()->sync($data['menu_item_ids'] ?? []);
        return redirect()->route('admin.offers.index')->with('success', 'Aanbieding opgeslagen.');
    }

    public function edit(Offer $offer): View
    {
        return view('admin.offers.edit', [
            'offer' => $offer->load('menuItems'),
            'menuItems' => $this->menuItems(),
        ]);
    }

    public function update(Request $request, Offer $offer): RedirectResponse
    {
        $data = $this->validated($request);

        $offer->update($data);
        $offer->menuItems()->sync($data['menu_item_ids'] ?? []);

        return redirect()->route('admin.offers.index')->with('success', 'Aanbieding bijgewerkt.');
    }

    public function destroy(Offer $offer): RedirectResponse
    {
        $offer->menuItems()->detach();
        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', 'Aanbieding verwijderd.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'discount_type' => ['required', 'in:fixed_price,amount_off,percentage'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after_or_equal:starts_at'],
            'menu_item_ids' => ['array'],
            'menu_item_ids.*' => ['exists:menu_items,id'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function menuItems()
    {
        return MenuItem::orderBy('number')->orderBy('suffix')->get();
    }
}
