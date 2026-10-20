<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            RestaurantTable::create([
                'code' => 'T' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'seats' => $i <= 4 ? 2 : 4,
                'is_active' => true,
            ]);
        }
    }
}