<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Soepen', 'sort_order' => 1],
            ['name' => 'Voorgerechten', 'sort_order' => 2],
            ['name' => 'Bami', 'sort_order' => 3],
            ['name' => 'Nasi', 'sort_order' => 4],
            ['name' => 'Rijsttafels', 'sort_order' => 5],
            ['name' => 'Dranken', 'sort_order' => 6],
            ['name' => 'Desserts', 'sort_order' => 7],
        ];

        foreach ($categories as $category) {
            MenuCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'sort_order' => $category['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}