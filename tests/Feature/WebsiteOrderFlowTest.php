<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RiceOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteOrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_takeaway_order_is_stored_and_thank_you_page_shows_summary(): void
    {
        [$menuItem, $riceOption] = $this->seedOrderCatalog();

        $response = $this->post(route('orders.store'), $this->formData([
            'customer_name' => 'Milan',
            'customer_phone' => '0612345678',
            'type' => 'takeaway',
            'notes' => 'Graag extra sambal',
            'items' => [
                [
                    'menu_item_id' => $menuItem->id,
                    'rice_option_id' => $riceOption->id,
                    'quantity' => 2,
                    'note' => 'Zonder ui',
                ],
            ],
        ]));

        $order = Order::query()->with('items.menuItem')->firstOrFail();

        $response->assertRedirect(route('orders.thank-you', $order));

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'customer_name' => 'Milan',
            'type' => 'takeaway',
        ]);

        $this->get(route('orders.thank-you', $order))
            ->assertOk()
            ->assertSee('Bestelnummer:')
            ->assertSee('Babi Pangang')
            ->assertSee('Open reviewformulier')
            ->assertSee('QR code met orderoverzicht');
    }

    public function test_delivery_order_requires_address_fields(): void
    {
        [$menuItem] = $this->seedOrderCatalog();

        $this->from(route('orders.create'))
            ->post(route('orders.store'), $this->formData([
                'customer_name' => 'Milan',
                'type' => 'delivery',
                'items' => [
                    [
                        'menu_item_id' => $menuItem->id,
                        'quantity' => 1,
                    ],
                ],
            ]))
            ->assertRedirect(route('orders.create'))
            ->assertSessionHasErrors([
                'customer_address',
                'customer_postcode',
                'customer_city',
            ]);
    }

    private function seedOrderCatalog(): array
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

        return [$menuItem, $riceOption];
    }
}
