<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function show(Order $order): View
    {
        return view('reviews.show', [
            'order' => $order->loadMissing(['items.menuItem', 'review', 'tableSession.table']),
        ]);
    }

    public function store(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'rating_food' => ['required', 'integer', 'between:1,5'],
            'rating_speed' => ['required', 'integer', 'between:1,5'],
            'rating_service' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        Review::updateOrCreate(
            ['order_id' => $order->id],
            $data,
        );

        return redirect()
            ->route('reviews.show', $order)
            ->with('success', 'Bedankt! Je review is verzonden.');
    }
}