<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RestaurantTable;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_form_is_available_for_an_order(): void
    {
        $order = $this->createOrder();

        $response = $this->get(route('reviews.show', $order));

        $response->assertOk();
        $response->assertSee('Hoe was jouw ervaring bij De Gouden Draak?');
        $response->assertSee('name="rating_food"', false);
        $response->assertSee('name="rating_speed"', false);
        $response->assertSee('name="rating_service"', false);
    }

    public function test_submitting_a_review_persists_feedback_and_shows_thank_you_state(): void
    {
        $order = $this->createOrder();

        $response = $this->post(route('reviews.store', $order), $this->formData([
            'rating_food' => 5,
            'rating_speed' => 4,
            'rating_service' => 5,
            'comment' => 'Lekker eten en vriendelijke service.',
        ]));

        $response->assertRedirect(route('reviews.show', $order));

        $this->assertDatabaseHas('reviews', [
            'order_id' => $order->id,
            'rating_food' => 5,
            'rating_speed' => 4,
            'rating_service' => 5,
            'comment' => 'Lekker eten en vriendelijke service.',
        ]);

        $this->get(route('reviews.show', $order))
            ->assertOk()
            ->assertSee('Bedankt voor je review!')
            ->assertSee('5/5')
            ->assertSee('4/5');
    }

    public function test_tablet_order_redirects_to_thank_you_page_with_review_link(): void
    {
        $category = MenuCategory::create([
            'name' => 'Specials',
            'slug' => 'specials',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $menuItem = MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 12,
            'name' => 'Babi Pangang',
            'price' => 18.50,
            'is_active' => true,
        ]);

        $table = RestaurantTable::create([
            'code' => 'T12',
            'seats' => 4,
            'is_active' => true,
        ]);

        $tableSession = TableSession::create([
            'restaurant_table_id' => $table->id,
            'guest_count' => 2,
            'status' => 'open',
        ]);

        $response = $this->post(route('tablet.orders.store', $tableSession), $this->formData([
            'items' => [
                [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => 2,
                    'note' => 'Extra saus',
                ],
            ],
        ]));

        $order = Order::query()->where('table_session_id', $tableSession->id)->firstOrFail();

        $response->assertRedirect(route('tablet.orders.thank-you', [$tableSession, $order]));

        $this->get(route('tablet.orders.thank-you', [$tableSession, $order]))
            ->assertOk()
            ->assertSee('Scan later de QR-code')
            ->assertSee(route('reviews.show', $order), false);
    }

    public function test_web_thank_you_page_links_to_the_review_form(): void
    {
        $order = $this->createOrder();

        $this->get(route('orders.thank-you', $order))
            ->assertOk()
            ->assertSee('Open reviewformulier')
            ->assertSee(route('reviews.show', $order), false);
    }

    private function createOrder(): Order
    {
        $category = MenuCategory::create([
            'name' => 'Test',
            'slug' => 'test',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $menuItem = MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 7,
            'name' => 'Foe Yong Hai',
            'price' => 16.50,
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'TEST-ORDER-1',
            'type' => 'table',
            'customer_name' => 'Tester',
            'total' => 16.50,
            'subtotal' => 16.50,
        ]);

        $order->items()->create([
            'menu_item_id' => $menuItem->id,
            'quantity' => 1,
            'unit_price' => 16.50,
            'rice_extra_price' => 0,
            'discount' => 0,
            'line_total' => 16.50,
        ]);

        return $order->fresh();
    }
}
