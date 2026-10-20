<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [1, 1, 'A', 'Tomatensoep', 'Verse tomatensoep', 4.50],
            [2, 2, 'B', 'Loempia Speciaal', 'Grote loempia met kip', 6.95],
            [3, 3, 'C', 'Bami Goreng', 'Gebakken bami met kip', 12.50],
            [4, 4, 'D', 'Nasi Goreng', 'Gebakken rijst met groenten', 11.95],
            [5, 5, 'E', 'Chinese Rijsttafel', 'Voor 2 personen', 29.95],
            [6, 6, 'F', 'Coca Cola', '33cl', 2.95],
            [7, 7, 'G', 'Bananenflensjes', 'Met ijs', 5.95],
        ];

        foreach ($items as [$categoryId, $number, $suffix, $name, $description, $price]) {
            MenuItem::create([
                'menu_category_id' => $categoryId,
                'number' => $number,
                'suffix' => $suffix,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image_path' => null,
                'is_active' => true,
            ]);
        }
    }
}