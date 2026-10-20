<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use App\Models\TableSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TableSessionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'restaurant_table_id' => ['required', 'exists:restaurant_tables,id'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:8'],
            'guest_ages' => ['nullable', 'array'],
            'deluxe_menu' => ['sometimes', 'boolean'],
        ]);

        RestaurantTable::findOrFail($data['restaurant_table_id']);
        $data['guest_ages'] = collect($data['guest_ages'] ?? [])->filter()->values()->all();
        $data['deluxe_menu'] = (bool) ($data['deluxe_menu'] ?? false);
        TableSession::create($data);
        return back()->with('success', 'Tafel geregistreerd.');
    }

    public function close(TableSession $tableSession): RedirectResponse
    {
        $tableSession->update(['status' => 'closed', 'closed_at' => now()]);
        return back()->with('success', 'Tafel gesloten.');
    }
}
