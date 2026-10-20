<?php

use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TableSessionController;
use App\Http\Controllers\POS\IndexController as PosIndexController;
use App\Http\Controllers\POS\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Tablet\HelpRequestController;
use App\Http\Controllers\Tablet\TableOrderController;
use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\OrderController;
use App\Models\HelpRequest;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RestaurantTable;
use App\Models\RiceOption;
use App\Models\Offer;
use App\Models\TableSession;
use Illuminate\Support\Facades\Route;

Route::view('/', 'website.home')->name('home');
Route::view('/nieuws', 'website.news')->name('news');
Route::view('/contact', 'website.contact')->name('contact');
Route::get('/aanbiedingen', function () {
    return view('website.offers', [
        'offers' => Offer::query()
            ->current()
            ->with('menuItems')
            ->orderBy('starts_at')
            ->get(),
    ]);
})->name('offers.public');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/bestellen', [OrderController::class, 'create'])->name('orders.create');
Route::post('/bestellen', [OrderController::class, 'store'])->name('orders.store');
Route::get('/bestellen/bedankt/{order}', function (Order $order) {
    return view('website.orders.thank-you', compact('order'));
})->name('orders.thank-you');
Route::get('/review/{order}', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('/review/{order}', [ReviewController::class, 'store'])->name('reviews.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'tables' => RestaurantTable::where('is_active', true)->orderBy('code')->get(),
            'sessions' => TableSession::with('table')->where('status', 'open')->latest()->get(),
            'helpRequests' => HelpRequest::with('tableSession.table')->latest()->limit(20)->get(),
        ]);
    })->name('dashboard');

    Route::resource('menu-items', MenuItemController::class);
    Route::resource('offers', OfferController::class)->except(['show']);
    Route::post('table-sessions', [TableSessionController::class, 'store'])->name('table-sessions.store');
    Route::patch('table-sessions/{tableSession}/close', [TableSessionController::class, 'close'])->name('table-sessions.close');
});

Route::get('/kassa', PosIndexController::class)->name('pos.index');
Route::get('/pos/search', SearchController::class)->name('pos.search');

Route::get('/tablet/{tableSession}', function (TableSession $tableSession) {
    $tableSession->load([
        'table',
        'orders' => fn ($query) => $query
            ->latest('ordered_at')
            ->with(['items.menuItem', 'items.riceOption']),
    ]);

    $orderHistory = $tableSession->orders
        ->map(fn (Order $order) => [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'round_number' => $order->round_number,
            'ordered_at' => $order->ordered_at?->format('d-m-Y H:i'),
            'total' => (float) $order->total,
            'items' => $order->items->map(fn ($item) => [
                'id' => $item->id,
                'quantity' => (int) $item->quantity,
                'note' => $item->note,
                'menu_item' => $item->menuItem ? [
                    'id' => $item->menuItem->id,
                    'number' => $item->menuItem->number,
                    'suffix' => $item->menuItem->suffix,
                    'name' => $item->menuItem->name,
                    'description' => $item->menuItem->description,
                    'price' => (float) $item->menuItem->price,
                ] : null,
                'rice_option' => $item->riceOption ? [
                    'id' => $item->riceOption->id,
                    'name' => $item->riceOption->name,
                    'extra_price' => (float) $item->riceOption->extra_price,
                ] : null,
            ])->values(),
        ])
        ->values();

    return view('tablet.show', [
        'tableSession' => $tableSession,
        'items' => MenuItem::where('is_active', true)->orderBy('number')->get(),
        'riceOptions' => RiceOption::where('is_active', true)->orderBy('sort_order')->get(),
        'orderHistory' => $orderHistory,
    ]);
})->name('tablet.show');
Route::prefix('tablet/{tableSession}')->name('tablet.')->group(function () {
    Route::post('orders', [TableOrderController::class, 'store'])->name('orders.store');
    Route::get('orders/{order}/bedankt', [TableOrderController::class, 'thankYou'])->name('orders.thank-you');
    Route::post('help', [HelpRequestController::class, 'store'])->name('help.store');
});
Route::patch('/help-requests/{helpRequest}', [HelpRequestController::class, 'update'])->name('help-requests.update');
