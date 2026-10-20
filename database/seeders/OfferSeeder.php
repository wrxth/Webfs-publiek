<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        Offer::create([
            'title' => 'Weekmenu',
            'description' => 'Bami + Loempia + Cola',
            'discount_type' => 'percentage',
            'discount_value' => 15,
            'starts_at' => now()->toDateString(),
            'ends_at' => now()->addWeek()->toDateString(),
            'is_active' => true,
        ]);

        Offer::create([
            'title' => 'Studentenkorting',
            'description' => '10% korting op vertoon van studentenpas',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'starts_at' => now()->toDateString(),
            'ends_at' => now()->addMonth()->toDateString(),
            'is_active' => true,
        ]);
    }
}