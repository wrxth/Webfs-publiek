<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RiceOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View
    {
        return view('website.orders.create', [
            'items' => MenuItem::where('is_active', true)->orderBy('number')->get(),
            'riceOptions' => RiceOption::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:30'],
            'type' => ['required', 'in:takeaway,delivery'],
            'customer_address' => ['nullable', 'required_if:type,delivery', 'string', 'max:255'],
            'customer_postcode' => ['nullable', 'required_if:type,delivery', 'string', 'max:20'],
            'customer_city' => ['nullable', 'required_if:type,delivery', 'string', 'max:120'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'items.*.rice_option_id' => ['nullable', 'exists:rice_options,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.note' => ['nullable', 'string', 'max:500'],
        ]);

        $order = DB::transaction(function () use ($data) {
            $order = Order::create([
                'order_number' => now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'type' => $data['type'],
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'customer_address' => $data['customer_address'] ?? null,
                'customer_postcode' => $data['customer_postcode'] ?? null,
                'customer_city' => $data['customer_city'] ?? null,
                'delivery_fee' => $data['type'] === 'delivery' ? 2.50 : 0,
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $row) {
                $menuItem = MenuItem::findOrFail($row['menu_item_id']);
                $rice = !empty($row['rice_option_id']) ? RiceOption::find($row['rice_option_id']) : null;
                $unit = (float) $menuItem->price;
                $extra = $rice ? (float) $rice->extra_price : 0;
                $quantity = (int) $row['quantity'];

                $order->items()->create([
                    'menu_item_id' => $menuItem->id,
                    'rice_option_id' => $rice?->id,
                    'quantity' => $quantity,
                    'unit_price' => $unit,
                    'rice_extra_price' => $extra,
                    'note' => $row['note'] ?? null,
                    'line_total' => ($unit + $extra) * $quantity,
                ]);
            }

            $order->recalculate();
            return $order;
        });

        return redirect()->route('orders.thank-you', $order);
    }
}
