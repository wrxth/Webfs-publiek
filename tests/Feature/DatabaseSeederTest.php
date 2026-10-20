<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_loads_demo_and_legacy_menu_data(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertGreaterThanOrEqual(20, DB::table('menu_categories')->count());
        $this->assertGreaterThanOrEqual(150, DB::table('menu_items')->count());
        $this->assertGreaterThanOrEqual(4, DB::table('rice_options')->count());
        $this->assertGreaterThanOrEqual(1, DB::table('offers')->count());
        $this->assertGreaterThanOrEqual(1, DB::table('restaurant_tables')->count());
    }
}
