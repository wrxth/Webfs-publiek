<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RiceOption;
use App\Models\TableSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TableOrderController extends Controller
{
    public function store(Request $request, TableSession $tableSession): RedirectResponse
    {
        $latestOrder = $tableSession->orders()->latest('ordered_at')->first();
        if ($latestOrder && $latestOrder->ordered_at->gt(now()->subMinutes(10))) {
            throw ValidationException::withMessages(['table' => 'Je kan maar 1 keer per 10 minuten bestellen.']);
        }

        $round = $tableSession->orders()->max('round_number') + 1;
        if ($round > 5) {
            throw ValidationException::withMessages(['table' => 'Maximaal 5 bestelrondes per tafel.']);
        }

        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'items.*.rice_option_id' => ['nullable', 'exists:rice_options,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.note' => ['nullable', 'string', 'max:500'],
        ]);

        $order = DB::transaction(function () use ($data, $tableSession, $round) {
            $order = Order::create([
                'order_number' => 'T' . $tableSession->id . '-' . strtoupper(Str::random(6)),
                'table_session_id' => $tableSession->id,
                'type' => 'table',
                'round_number' => $round,
            ]);

            foreach ($data['items'] as $row) {
                $menuItem = MenuItem::findOrFail($row['menu_item_id']);
                $rice = !empty($row['rice_option_id']) ? RiceOption::find($row['rice_option_id']) : null;
                $quantity = (int) $row['quantity'];
                $order->items()->create([
                    'menu_item_id' => $menuItem->id,
                    'rice_option_id' => $rice?->id,
                    'quantity' => $quantity,
                    'unit_price' => $menuItem->price,
                    'rice_extra_price' => $rice?->extra_price ?? 0,
                    'note' => $row['note'] ?? null,
                    'line_total' => (((float) $menuItem->price) + ((float) ($rice?->extra_price ?? 0))) * $quantity,
                ]);
            }
            $order->recalculate();
            return $order;
        });

        return redirect()
            ->route('tablet.orders.thank-you', [$tableSession, $order])
            ->with('success', 'Bestelling geplaatst.');
    }

    public function thankYou(TableSession $tableSession, Order $order): View
    {
        abort_unless($order->table_session_id === $tableSession->id, 404);

        return view('tablet.orders.thank-you', [
            'tableSession' => $tableSession->loadMissing('table'),
            'order' => $order->loadMissing(['items.menuItem', 'review']),
        ]);
    }
}
