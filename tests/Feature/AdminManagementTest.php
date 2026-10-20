<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Offer;
use App\Models\RestaurantTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_and_menu_item_index_load(): void
    {
        RestaurantTable::create([
            'code' => 'T1',
            'seats' => 4,
            'is_active' => true,
        ]);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Admin dashboard')
            ->assertSee('Tafel registreren');

        $this->get(route('admin.menu-items.index'))
            ->assertOk()
            ->assertSee('Gerechten');
    }

    public function test_admin_can_create_update_and_delete_offer(): void
    {
        $category = MenuCategory::create([
            'name' => 'Voor',
            'slug' => 'voor',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $menuItem = MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 14,
            'suffix' => 'A',
            'name' => 'Vegetarische mini loempia',
            'price' => 5.40,
            'is_active' => true,
        ]);

        $this->post(route('admin.offers.store'), $this->formData([
            'title' => 'Weekenddeal',
            'description' => 'Speciaal voor vrijdag',
            'discount_type' => 'percentage',
            'discount_value' => 15,
            'starts_at' => now()->toDateString(),
            'ends_at' => now()->addDays(2)->toDateString(),
            'menu_item_ids' => [$menuItem->id],
            'is_active' => '1',
        ]))->assertRedirect(route('admin.offers.index'));

        $offer = Offer::query()->firstOrFail();

        $this->assertDatabaseHas('offers', [
            'id' => $offer->id,
            'title' => 'Weekenddeal',
            'discount_type' => 'percentage',
        ]);

        $this->patch(route('admin.offers.update', $offer), $this->formData([
            'title' => 'Weekenddeal XL',
            'description' => 'Speciaal voor het hele weekend',
            'discount_type' => 'fixed_price',
            'discount_value' => 8.95,
            'starts_at' => now()->toDateString(),
            'ends_at' => now()->addDays(3)->toDateString(),
            'menu_item_ids' => [$menuItem->id],
        ]))->assertRedirect(route('admin.offers.index'));

        $this->assertDatabaseHas('offers', [
            'id' => $offer->id,
            'title' => 'Weekenddeal XL',
            'discount_type' => 'fixed_price',
            'is_active' => false,
        ]);

        $this->delete(route('admin.offers.destroy', $offer), $this->formData([]))
            ->assertRedirect(route('admin.offers.index'));

        $this->assertDatabaseMissing('offers', [
            'id' => $offer->id,
        ]);
    }
}
