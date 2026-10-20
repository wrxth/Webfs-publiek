<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RestaurantTable;
use App\Models\RiceOption;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TabletOrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_tablet_view_contains_previous_order_history_for_the_same_session(): void
    {
        $category = MenuCategory::create([
            'name' => 'Vlees',
            'slug' => 'vlees',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $menuItem = MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 70,
            'name' => 'Babi Pangang',
            'price' => 12.20,
            'is_active' => true,
        ]);

        $riceOption = RiceOption::create([
            'name' => 'Nasi of bami goreng',
            'extra_price' => 0.90,
            'sort_order' => 20,
            'is_active' => true,
        ]);

        $table = RestaurantTable::create([
            'code' => 'T5',
            'seats' => 4,
            'is_active' => true,
        ]);

        $tableSession = TableSession::create([
            'restaurant_table_id' => $table->id,
            'guest_count' => 2,
            'status' => 'open',
        ]);

        $order = Order::create([
            'order_number' => 'T5-ABC123',
            'table_session_id' => $tableSession->id,
            'type' => 'table',
            'round_number' => 1,
            'subtotal' => 13.10,
            'total' => 13.10,
        ]);

        $order->items()->create([
            'menu_item_id' => $menuItem->id,
            'rice_option_id' => $riceOption->id,
            'quantity' => 2,
            'unit_price' => 12.20,
            'rice_extra_price' => 0.90,
            'discount' => 0,
            'note' => 'Zonder ui',
            'line_total' => 26.20,
        ]);

        $response = $this->get(route('tablet.show', $tableSession));

        $response->assertOk();
        $response->assertSee('data-order-history=', false);
        $response->assertSee('T5-ABC123');
        $response->assertSee('Babi Pangang');
        $response->assertSee('Zonder ui');
        $response->assertSee('Nasi of bami goreng');
    }
}
