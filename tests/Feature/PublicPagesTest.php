<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('De Gouden Draak');
    }

    public function test_menu_search_matches_description_text(): void
    {
        $category = MenuCategory::create([
            'name' => 'Specials',
            'slug' => 'specials',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 88,
            'name' => 'Babi pangang speciaal',
            'description' => 'Met extra krokante ui en chilisaus',
            'price' => 18.50,
            'is_active' => true,
        ]);

        $this->get(route('menu.index', ['search' => 'krokante ui']))
            ->assertOk()
            ->assertSee('Babi pangang speciaal');
    }

    public function test_public_offer_pages_show_current_offers(): void
    {
        $category = MenuCategory::create([
            'name' => 'Acties',
            'slug' => 'acties',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $menuItem = MenuItem::create([
            'menu_category_id' => $category->id,
            'number' => 12,
            'name' => 'Mini loempia',
            'price' => 6.50,
            'is_active' => true,
        ]);

        $currentOffer = Offer::create([
            'title' => 'Lunchdeal',
            'description' => 'Alleen deze week',
            'discount_type' => 'fixed_price',
            'discount_value' => 9.95,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
            'is_active' => true,
        ]);
        $currentOffer->menuItems()->attach($menuItem);

        Offer::create([
            'title' => 'Verlopen deal',
            'description' => 'Niet meer zichtbaar',
            'discount_type' => 'fixed_price',
            'discount_value' => 4.95,
            'starts_at' => now()->subDays(10),
            'ends_at' => now()->subDays(5),
            'is_active' => true,
        ]);

        $this->get(route('offers.public'))
            ->assertOk()
            ->assertSee('Lunchdeal')
            ->assertDontSee('Verlopen deal');

        $this->get(route('menu.index'))
            ->assertOk()
            ->assertSee('Actieve aanbiedingen')
            ->assertSee('Lunchdeal');
    }
}
