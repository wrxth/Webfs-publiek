<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\RiceOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OldWebfsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [];
        $categories['SOEP'] = MenuCategory::updateOrCreate(['slug' => Str::slug('SOEP')], ['name' => 'SOEP', 'sort_order' => 10, 'is_active' => true]);
        $categories['VOORGERECHT'] = MenuCategory::updateOrCreate(['slug' => Str::slug('VOORGERECHT')], ['name' => 'VOORGERECHT', 'sort_order' => 20, 'is_active' => true]);
        $categories['BAMI EN NASI GERECHTEN'] = MenuCategory::updateOrCreate(['slug' => Str::slug('BAMI EN NASI GERECHTEN')], ['name' => 'BAMI EN NASI GERECHTEN', 'sort_order' => 30, 'is_active' => true]);
        $categories['COMBINATIE GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('COMBINATIE GERECHTEN (met witte rijst)')], ['name' => 'COMBINATIE GERECHTEN (met witte rijst)', 'sort_order' => 40, 'is_active' => true]);
        $categories['MIHOEN GERECHTEN'] = MenuCategory::updateOrCreate(['slug' => Str::slug('MIHOEN GERECHTEN')], ['name' => 'MIHOEN GERECHTEN', 'sort_order' => 50, 'is_active' => true]);
        $categories['CHINESE BAMI GERECHTEN'] = MenuCategory::updateOrCreate(['slug' => Str::slug('CHINESE BAMI GERECHTEN')], ['name' => 'CHINESE BAMI GERECHTEN', 'sort_order' => 60, 'is_active' => true]);
        $categories['INDISCHE GERECHTEN'] = MenuCategory::updateOrCreate(['slug' => Str::slug('INDISCHE GERECHTEN')], ['name' => 'INDISCHE GERECHTEN', 'sort_order' => 70, 'is_active' => true]);
        $categories['EIERGERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('EIERGERECHTEN (met witte rijst)')], ['name' => 'EIERGERECHTEN (met witte rijst)', 'sort_order' => 80, 'is_active' => true]);
        $categories['GROENTEN GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('GROENTEN GERECHTEN (met witte rijst)')], ['name' => 'GROENTEN GERECHTEN (met witte rijst)', 'sort_order' => 90, 'is_active' => true]);
        $categories['VLEES GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('VLEES GERECHTEN (met witte rijst)')], ['name' => 'VLEES GERECHTEN (met witte rijst)', 'sort_order' => 100, 'is_active' => true]);
        $categories['KIP GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('KIP GERECHTEN (met witte rijst)')], ['name' => 'KIP GERECHTEN (met witte rijst)', 'sort_order' => 110, 'is_active' => true]);
        $categories['GARNALEN GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('GARNALEN GERECHTEN (met witte rijst)')], ['name' => 'GARNALEN GERECHTEN (met witte rijst)', 'sort_order' => 120, 'is_active' => true]);
        $categories['OSSENHAAS GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('OSSENHAAS GERECHTEN (met witte rijst)')], ['name' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'sort_order' => 130, 'is_active' => true]);
        $categories['VISSEN GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('VISSEN GERECHTEN (met witte rijst)')], ['name' => 'VISSEN GERECHTEN (met witte rijst)', 'sort_order' => 140, 'is_active' => true]);
        $categories['PEKING EEND GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('PEKING EEND GERECHTEN (met witte rijst)')], ['name' => 'PEKING EEND GERECHTEN (met witte rijst)', 'sort_order' => 150, 'is_active' => true]);
        $categories['TIEPAN SPECIALITEITEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('TIEPAN SPECIALITEITEN (met witte rijst)')], ['name' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'sort_order' => 160, 'is_active' => true]);
        $categories['VEGETARISCHE GERECHTEN (met witte rijst)'] = MenuCategory::updateOrCreate(['slug' => Str::slug('VEGETARISCHE GERECHTEN (met witte rijst)')], ['name' => 'VEGETARISCHE GERECHTEN (met witte rijst)', 'sort_order' => 170, 'is_active' => true]);
        $categories['KINDERMENUS'] = MenuCategory::updateOrCreate(['slug' => Str::slug('KINDERMENUS')], ['name' => 'KINDERMENUS', 'sort_order' => 180, 'is_active' => true]);
        $categories['RIJSTTAFELS'] = MenuCategory::updateOrCreate(['slug' => Str::slug('RIJSTTAFELS')], ['name' => 'RIJSTTAFELS', 'sort_order' => 190, 'is_active' => true]);
        $categories['BUFFET'] = MenuCategory::updateOrCreate(['slug' => Str::slug('BUFFET')], ['name' => 'BUFFET', 'sort_order' => 200, 'is_active' => true]);
        $categories['DIVERSEN'] = MenuCategory::updateOrCreate(['slug' => Str::slug('DIVERSEN')], ['name' => 'DIVERSEN', 'sort_order' => 210, 'is_active' => true]);

        $items = [
            ['category' => 'SOEP', 'number' => 1, 'suffix' => null, 'name' => 'Soep Ling Fa', 'price' => 3.8, 'description' => null],
            ['category' => 'SOEP', 'number' => 2, 'suffix' => null, 'name' => 'Kippensoep', 'price' => 2.9, 'description' => null],
            ['category' => 'SOEP', 'number' => 3, 'suffix' => null, 'name' => 'Tomatensoep', 'price' => 2.9, 'description' => null],
            ['category' => 'SOEP', 'number' => 4, 'suffix' => null, 'name' => 'Haaienvinnensoep', 'price' => 3.1, 'description' => null],
            ['category' => 'SOEP', 'number' => 5, 'suffix' => null, 'name' => 'Champignonsoep', 'price' => 3.3, 'description' => null],
            ['category' => 'SOEP', 'number' => 6, 'suffix' => null, 'name' => 'Pekingsoep', 'price' => 3.8, 'description' => null],
            ['category' => 'SOEP', 'number' => 7, 'suffix' => null, 'name' => 'Wan Tan Soep', 'price' => 4.3, 'description' => null],
            ['category' => 'SOEP', 'number' => 8, 'suffix' => null, 'name' => 'Chinese Champignonsoep', 'price' => 4.1, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 10, 'suffix' => null, 'name' => 'Loempia Ling Fa', 'price' => 6.2, 'description' => 'met atjar, ananas en pindasaus'],
            ['category' => 'VOORGERECHT', 'number' => 11, 'suffix' => null, 'name' => 'Loempia Compleet', 'price' => 6.2, 'description' => 'met gesmoord rundvlees en pikante saus'],
            ['category' => 'VOORGERECHT', 'number' => 12, 'suffix' => null, 'name' => 'Loempia met Kip', 'price' => 3.9, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 13, 'suffix' => null, 'name' => 'Loempia', 'price' => 3.8, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 14, 'suffix' => null, 'name' => 'Chinese mini loempia', 'price' => 4.9, 'description' => '4 st.'],
            ['category' => 'VOORGERECHT', 'number' => 14, 'suffix' => 'A', 'name' => 'Vegetarische mini loempia', 'price' => 4.9, 'description' => '12 st.'],
            ['category' => 'VOORGERECHT', 'number' => 15, 'suffix' => null, 'name' => 'Kroepoek', 'price' => 2.5, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 15, 'suffix' => 'A', 'name' => 'Casave Kroepoek', 'price' => 2.7, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 16, 'suffix' => null, 'name' => 'Pangsit Goreng', 'price' => 3.9, 'description' => '7 st.'],
            ['category' => 'VOORGERECHT', 'number' => 17, 'suffix' => null, 'name' => 'Pisang Goreng', 'price' => 3.4, 'description' => '5 st.'],
            ['category' => 'VOORGERECHT', 'number' => 18, 'suffix' => null, 'name' => 'Chinese Dim Sum', 'price' => 5.4, 'description' => 'mini loempia, kerry ko, pangsit goreng, garnalenpasteitje'],
            ['category' => 'VOORGERECHT', 'number' => 19, 'suffix' => null, 'name' => 'Saté Babi', 'price' => 5.4, 'description' => '4 st.'],
            ['category' => 'VOORGERECHT', 'number' => 20, 'suffix' => null, 'name' => 'Saté Ajam', 'price' => 5.4, 'description' => '4 st.'],
            ['category' => 'VOORGERECHT', 'number' => 20, 'suffix' => 'A', 'name' => 'Saté Garnalen', 'price' => 9.9, 'description' => '3 st.'],
            ['category' => 'VOORGERECHT', 'number' => 21, 'suffix' => null, 'name' => 'Fong Mei Ha', 'price' => 8.1, 'description' => 'krokant gepaneerd garnalen. 4 st.'],
            ['category' => 'VOORGERECHT', 'number' => 22, 'suffix' => null, 'name' => 'Patat', 'price' => 2.3, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 23, 'suffix' => null, 'name' => 'Tsa Siu Mai', 'price' => 3.5, 'description' => 'gebakken vleespasteitje. 4 st.'],
            ['category' => 'VOORGERECHT', 'number' => 24, 'suffix' => null, 'name' => 'Atjar', 'price' => 3.0, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 25, 'suffix' => null, 'name' => 'Witte Rijst', 'price' => 3.0, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 26, 'suffix' => null, 'name' => 'Grote pindasaus', 'price' => 3.9, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 27, 'suffix' => null, 'name' => 'Kleine pindasaus', 'price' => 2.3, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 28, 'suffix' => null, 'name' => 'Kippenpootje', 'price' => 2.3, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 29, 'suffix' => null, 'name' => 'Halve kip', 'price' => 6.0, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 29, 'suffix' => 'H', 'name' => 'Kroket', 'price' => 1.4, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 29, 'suffix' => 'G', 'name' => 'Frikandel', 'price' => 1.4, 'description' => null],
            ['category' => 'VOORGERECHT', 'number' => 180, 'suffix' => 'H', 'name' => 'Kleine Sambal', 'price' => 2.5, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 30, 'suffix' => null, 'name' => 'Bami of Nasi Goreng Ling Fa', 'price' => 14.3, 'description' => 'Foe Yong Hai, Babi Pangang, saté en kippenpootje'],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 31, 'suffix' => null, 'name' => 'Bami of Nasi Goreng met ei', 'price' => 5.0, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 32, 'suffix' => null, 'name' => 'Bami of Nasi Goreng speciaal', 'price' => 8.5, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 33, 'suffix' => null, 'name' => 'Bami of Nasi Goreng met saté', 'price' => 8.5, 'description' => '3 st.'],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 34, 'suffix' => null, 'name' => 'Nasi Yeung Chow', 'price' => 10.9, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 34, 'suffix' => 'A', 'name' => 'Nasi Yeung Chow', 'price' => 13.0, 'description' => 'met garnaaltjes en Cha Sieuw-vlees'],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 35, 'suffix' => null, 'name' => 'Bami of Nasi Malay', 'price' => 9.3, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 36, 'suffix' => null, 'name' => 'Bami of Nasi met kipfilet', 'price' => 9.3, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 37, 'suffix' => null, 'name' => 'Bami of Nasi met varkensvlees', 'price' => 9.3, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 38, 'suffix' => null, 'name' => 'Bami of Nasi met garnalen', 'price' => 14.3, 'description' => null],
            ['category' => 'BAMI EN NASI GERECHTEN', 'number' => 39, 'suffix' => null, 'name' => 'Bami of Nasi met ossenhaas', 'price' => 15.3, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 40, 'suffix' => null, 'name' => 'Babi Pangang, Foe Yong Hani en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 41, 'suffix' => null, 'name' => 'Babi Pangang, Tjap Tjoy en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 42, 'suffix' => null, 'name' => 'Babi Pangang, Koe Loe Yuk en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 43, 'suffix' => null, 'name' => 'Babi Pangang, Tau Sie Kai en saté', 'price' => 16.5, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 44, 'suffix' => null, 'name' => 'Koe Loe Yuk, Foe Yong Hai en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 45, 'suffix' => null, 'name' => 'Koe Loe Yuk, Tjap Tjoy en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 46, 'suffix' => null, 'name' => 'Foe Yong Hai, Tjap Tjoy en saté', 'price' => 15.8, 'description' => null],
            ['category' => 'COMBINATIE GERECHTEN (met witte rijst)', 'number' => 47, 'suffix' => null, 'name' => 'Foe Yong Hai, Kip Kerrie en Saté', 'price' => 16.5, 'description' => null],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 50, 'suffix' => null, 'name' => 'Mihoen Ling Fa', 'price' => 16.4, 'description' => 'Foe Yong Hai, Babi Pangang, saté en kippenpootje'],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 51, 'suffix' => null, 'name' => 'Mihoen met varkensvlees', 'price' => 9.3, 'description' => null],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 52, 'suffix' => null, 'name' => 'Mihoen met kipfilet', 'price' => 10.4, 'description' => null],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 53, 'suffix' => null, 'name' => 'Mihoen met ossenhaas', 'price' => 16.4, 'description' => null],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 54, 'suffix' => null, 'name' => 'Mihoen met garnalen', 'price' => 15.3, 'description' => null],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 55, 'suffix' => null, 'name' => 'Mihoen Singapore-style', 'price' => 11.9, 'description' => 'met kleine garnaaltjes en Cha Sieuw-vlees en kerrie poeder'],
            ['category' => 'MIHOEN GERECHTEN', 'number' => 56, 'suffix' => null, 'name' => 'Mihoen met Cha Sieuw vlees', 'price' => 11.2, 'description' => null],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 57, 'suffix' => null, 'name' => 'Chinese Bami Ling Fa', 'price' => 16.9, 'description' => 'Foe Yong Hai, Babi Pangang, saté en kippenpootje'],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 58, 'suffix' => null, 'name' => 'Chinese Bami met varkensvlees', 'price' => 10.1, 'description' => null],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 58, 'suffix' => 'A', 'name' => 'Chinese Bami met kipfilet', 'price' => 11.2, 'description' => null],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 58, 'suffix' => 'B', 'name' => 'Chinese Bami met Cha Sieuw-vlees', 'price' => 12.2, 'description' => null],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 58, 'suffix' => 'C', 'name' => 'Chinese Bami met garnalen', 'price' => 15.8, 'description' => null],
            ['category' => 'CHINESE BAMI GERECHTEN', 'number' => 58, 'suffix' => 'D', 'name' => 'Chinese Bami met ossenhaas', 'price' => 17.4, 'description' => null],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M1', 'name' => 'Bami of Nasi Rames Ling Fa', 'price' => 15.3, 'description' => 'Babi Pangan, Foe Yong Hai, Daging Roedjak, Atjar en kippootje'],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M2', 'name' => 'Bami of Nasi Rames', 'price' => 8.8, 'description' => null],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M3', 'name' => 'Bami of Nasi Rames speciaal', 'price' => 10.8, 'description' => null],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M4', 'name' => 'Gado Gado', 'price' => 7.6, 'description' => 'met witte rijst'],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M5', 'name' => 'Daging Smoor', 'price' => 13.3, 'description' => 'met witte rijst'],
            ['category' => 'INDISCHE GERECHTEN', 'number' => null, 'suffix' => 'M6', 'name' => 'Daging Roedjak', 'price' => 13.3, 'description' => 'met witte rijst'],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 59, 'suffix' => null, 'name' => 'Foe Yong Hai Ling Fa', 'price' => 16.4, 'description' => 'ossenhaas, garnalen en kipfilet'],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 60, 'suffix' => null, 'name' => 'Foe Yong Hai met varkensvlees', 'price' => 8.8, 'description' => null],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 61, 'suffix' => null, 'name' => 'Foe Yong Hai met kipfilet', 'price' => 9.2, 'description' => null],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 62, 'suffix' => null, 'name' => 'Foe Yong Hai met garnalen', 'price' => 15.3, 'description' => null],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 63, 'suffix' => null, 'name' => 'Foe Yong Hai met krab', 'price' => 15.3, 'description' => null],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 63, 'suffix' => 'A', 'name' => 'Foe Yong Hai met Cha Sieuw Vlees', 'price' => 11.2, 'description' => null],
            ['category' => 'EIERGERECHTEN (met witte rijst)', 'number' => 63, 'suffix' => 'B', 'name' => 'Foe Yong Hai met ossenhaas', 'price' => 16.4, 'description' => null],
            ['category' => 'GROENTEN GERECHTEN (met witte rijst)', 'number' => 64, 'suffix' => null, 'name' => 'Tjap Tjoy Ling Fa', 'price' => 16.4, 'description' => 'ossenhaas, garnalen en kipfilet'],
            ['category' => 'GROENTEN GERECHTEN (met witte rijst)', 'number' => 65, 'suffix' => null, 'name' => 'Tjap Tjoy met varkensvlees', 'price' => 8.8, 'description' => null],
            ['category' => 'GROENTEN GERECHTEN (met witte rijst)', 'number' => 66, 'suffix' => null, 'name' => 'Tjap Tjoy met kipfilet', 'price' => 9.2, 'description' => null],
            ['category' => 'GROENTEN GERECHTEN (met witte rijst)', 'number' => 67, 'suffix' => null, 'name' => 'Tjap Tjoy met ossenhaas', 'price' => 16.4, 'description' => null],
            ['category' => 'GROENTEN GERECHTEN (met witte rijst)', 'number' => 68, 'suffix' => null, 'name' => 'Tjap Tjoy met garnalen', 'price' => 15.3, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 70, 'suffix' => null, 'name' => 'Babi Pangang', 'price' => 12.2, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 71, 'suffix' => null, 'name' => 'Babi Pangang in ketjapsaus', 'price' => 12.3, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 72, 'suffix' => null, 'name' => 'Cha Sieuw', 'price' => 13.3, 'description' => 'rood geroosterd varkensvlees'],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 73, 'suffix' => null, 'name' => 'Cha Sieuw in pikante saus', 'price' => 13.8, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 74, 'suffix' => null, 'name' => 'Geroosterde speenvarken', 'price' => 13.8, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 75, 'suffix' => null, 'name' => 'Koe Loe Yuk', 'price' => 11.9, 'description' => 'bolletjes vlees met zoetzure saus'],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 76, 'suffix' => null, 'name' => 'Varkenshaas met kerriesaus', 'price' => 11.9, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 77, 'suffix' => null, 'name' => 'Varkenshaas met ketjapsaus', 'price' => 11.9, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 78, 'suffix' => null, 'name' => 'Varkenshaas met tomatensaus', 'price' => 11.9, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 78, 'suffix' => 'A', 'name' => 'Varkenshaas met champignons in knoflooksaus', 'price' => 11.9, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 78, 'suffix' => 'B', 'name' => 'Varkenshaas met Chinese champignons', 'price' => 12.2, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 79, 'suffix' => null, 'name' => 'Varkenshaas met zwarte bonensaus', 'price' => 12.2, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 79, 'suffix' => 'A', 'name' => 'Varkenshaas met verse ananas in zoetzure saus', 'price' => 13.3, 'description' => null],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 79, 'suffix' => 'B', 'name' => 'Yu Sian Yuk', 'price' => 13.3, 'description' => 'varkenshaas met licht zoet pikante kruiden saus'],
            ['category' => 'VLEES GERECHTEN (met witte rijst)', 'number' => 79, 'suffix' => 'C', 'name' => 'SzeChuan Yuk', 'price' => 13.3, 'description' => 'varkenshaas met pittige kruiden saus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 80, 'suffix' => null, 'name' => 'Ajam Pangang', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 81, 'suffix' => null, 'name' => 'Ajam Pangang in ketjapsaus', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 82, 'suffix' => null, 'name' => 'Koe Loe Kai', 'price' => 13.0, 'description' => 'bolletjes kip met zoetzure saus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 83, 'suffix' => null, 'name' => 'Kipfilet met kerriesaus', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 84, 'suffix' => null, 'name' => 'Kipfilet met champignons in knoflooksaus', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 85, 'suffix' => null, 'name' => 'Kipfilet met tomatensaus', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 86, 'suffix' => null, 'name' => 'Kipfilet met ketjapsaus', 'price' => 13.0, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 87, 'suffix' => null, 'name' => 'Kipfilet met broccoli in knoflooksaus', 'price' => 13.3, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 88, 'suffix' => null, 'name' => 'Kipfilet met Chinese champignons', 'price' => 13.3, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 89, 'suffix' => null, 'name' => 'Kipfilet met zwarte pepersaus', 'price' => 13.3, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 90, 'suffix' => null, 'name' => 'Kipfilet met verse ananas in zoetzure saus', 'price' => 13.3, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 91, 'suffix' => null, 'name' => 'Kipfilet met zwarte pepersaus', 'price' => 13.3, 'description' => null],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 92, 'suffix' => null, 'name' => 'Tjieuw Yem Kai', 'price' => 13.3, 'description' => 'licht gebraden kipfilet met zout en peper'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 93, 'suffix' => null, 'name' => 'Yao Koe Kai', 'price' => 13.3, 'description' => 'kipfilet met cashewnoten in licht pikante saus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 94, 'suffix' => null, 'name' => 'Lychee Kai', 'price' => 13.8, 'description' => 'licht gebraden kipfilet met lychee in zoetzure saus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 95, 'suffix' => null, 'name' => 'Yu Sian Kai', 'price' => 13.3, 'description' => 'kipfilet met licht zoet pikante kruidensaus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 96, 'suffix' => null, 'name' => 'Sze Chuan Kai', 'price' => 13.8, 'description' => 'kipfilet met pittige kruidensaus'],
            ['category' => 'KIP GERECHTEN (met witte rijst)', 'number' => 97, 'suffix' => null, 'name' => 'Kung Bao Kai', 'price' => 13.8, 'description' => 'kipfilet met cashewnoten in pittige saus'],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 98, 'suffix' => null, 'name' => 'Garnalen met champignons in knoflooksaus', 'price' => 15.9, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 99, 'suffix' => null, 'name' => 'Garnalen met tomatensaus', 'price' => 15.9, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 100, 'suffix' => null, 'name' => 'Garnalen met ketjapsaus', 'price' => 15.9, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 101, 'suffix' => null, 'name' => 'Garnalen met broccoli', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 102, 'suffix' => null, 'name' => 'Garnalen met Chinese champignons', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 103, 'suffix' => null, 'name' => 'Garnalen met kerriesaus', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 104, 'suffix' => null, 'name' => 'Garnalen met zwarte bonensaus', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 105, 'suffix' => null, 'name' => 'Garnalen met zwarte pepersaus', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 106, 'suffix' => null, 'name' => 'Garnalen met chilisaus', 'price' => 16.1, 'description' => null],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 107, 'suffix' => null, 'name' => 'Yu Sian Haa', 'price' => 16.1, 'description' => 'garnalen met licht zoet pikante kruidensaus'],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 108, 'suffix' => null, 'name' => 'Tjieuw Yem Haa', 'price' => 16.1, 'description' => 'licht gebraden garnalen met zout en peper'],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 109, 'suffix' => null, 'name' => 'Tja Tai Haa', 'price' => 16.1, 'description' => 'krokant gebakken garnalen'],
            ['category' => 'GARNALEN GERECHTEN (met witte rijst)', 'number' => 110, 'suffix' => null, 'name' => 'Sze Chuan Haa', 'price' => 16.4, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 111, 'suffix' => null, 'name' => 'Ossenhaas met chanpignons in knoflooksaus', 'price' => 16.9, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 112, 'suffix' => null, 'name' => 'Ossenhaas met tomatensaus', 'price' => 16.9, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 113, 'suffix' => null, 'name' => 'Ossenhaas met ketjapsaus', 'price' => 16.9, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 114, 'suffix' => null, 'name' => 'Ossenhaas met broccoli', 'price' => 17.1, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 115, 'suffix' => null, 'name' => 'Ossenhaas met Chinese champignons', 'price' => 17.1, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 116, 'suffix' => null, 'name' => 'Ossenhaas met kerriesaus', 'price' => 17.1, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 117, 'suffix' => null, 'name' => 'Ossenhaas met zwarte bonensaus', 'price' => 17.1, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 118, 'suffix' => null, 'name' => 'Ossenhaas met zwarte pepersaus', 'price' => 17.1, 'description' => null],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 119, 'suffix' => null, 'name' => 'Yu Sian Ngau Yuk', 'price' => 17.1, 'description' => 'ossenhaas met licht zoet pikante kruidensaus'],
            ['category' => 'OSSENHAAS GERECHTEN (met witte rijst)', 'number' => 120, 'suffix' => null, 'name' => 'Sze Chuan Ngau Yuk', 'price' => 17.4, 'description' => 'ossenhaas met pittige kruidensaus'],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 121, 'suffix' => null, 'name' => 'Visfilet met kerriesaus', 'price' => 14.5, 'description' => null],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 122, 'suffix' => null, 'name' => 'Visfilet met oestersaus', 'price' => 14.5, 'description' => null],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 123, 'suffix' => null, 'name' => 'Visfilet met zoetzure saus', 'price' => 14.5, 'description' => 'licht gebraden visfilet in zoete pikante saus'],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 124, 'suffix' => null, 'name' => 'Hong Shau Yu', 'price' => 14.5, 'description' => 'licht gebraden visfilet in zoete pikante saus'],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 125, 'suffix' => null, 'name' => 'Tjeuw Yem Yu', 'price' => 15.0, 'description' => 'licht gebraden visfilet met zout en peper'],
            ['category' => 'VISSEN GERECHTEN (met witte rijst)', 'number' => 126, 'suffix' => null, 'name' => 'San Sching Po', 'price' => 16.1, 'description' => 'visfilet, garnalen, krab en groenten in knoflooksaus'],
            ['category' => 'PEKING EEND GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'P1', 'name' => 'Geroosterde Peking Eend', 'price' => 16.6, 'description' => null],
            ['category' => 'PEKING EEND GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'P2', 'name' => 'Peking Eend met verse ananas in zoetzure saus', 'price' => 17.1, 'description' => null],
            ['category' => 'PEKING EEND GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'P3', 'name' => 'Peking Eend met Chinese champignons in oestersaus', 'price' => 17.1, 'description' => null],
            ['category' => 'PEKING EEND GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'P4', 'name' => 'Yu Sian Ya', 'price' => 17.1, 'description' => 'peking eend met licht zoet pikante kruidensaus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'T1', 'name' => 'Tiepan Ling Fa', 'price' => 17.9, 'description' => 'garnalen, kipfilet, ossenhaas en groenten in zwarte pepersaus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'T2', 'name' => 'Tiepan Kai', 'price' => 15.3, 'description' => 'licht gebraden kipfilet en groenten met zoet pikante saus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'T3', 'name' => 'Tiepan San Yuk', 'price' => 17.1, 'description' => 'lichtgrbaden varkenshaas, kipfilet, ossenhaas en groenten met zoet pikante saus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'T4', 'name' => 'Tiepan Haa', 'price' => 17.4, 'description' => 'garnalen en groenten met zoet pikante saus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'T5', 'name' => 'Tiepan Ngau Yuk', 'price' => 19.5, 'description' => '5st. ossenhaas en groenten met zoet pikante saus'],
            ['category' => 'TIEPAN SPECIALITEITEN (met witte rijst)', 'number' => null, 'suffix' => 'V4', 'name' => 'Tau Fu Po', 'price' => 15.3, 'description' => 'sojakaas, cha sieuw garnalen en chinese paddenstoelen'],
            ['category' => 'VEGETARISCHE GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'V1', 'name' => 'Vegetarische Tjap Tjoy', 'price' => 8.3, 'description' => null],
            ['category' => 'VEGETARISCHE GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'V2', 'name' => 'Lo Han Zhai', 'price' => 11.2, 'description' => 'sojakaas, Chinese paddenstoelen en groenten in knoflooksaus'],
            ['category' => 'VEGETARISCHE GERECHTEN (met witte rijst)', 'number' => null, 'suffix' => 'V3', 'name' => 'Vegetarische Foe Yong Hai', 'price' => 8.3, 'description' => null],
            ['category' => 'KINDERMENUS', 'number' => null, 'suffix' => 'K1', 'name' => 'Frites, saté (2st.) en ei', 'price' => 6.5, 'description' => null],
            ['category' => 'KINDERMENUS', 'number' => null, 'suffix' => 'K2', 'name' => 'Frites, kippootje en ei', 'price' => 6.5, 'description' => null],
            ['category' => 'KINDERMENUS', 'number' => null, 'suffix' => 'K3', 'name' => 'Frites, mini loempia (2st.) en ei', 'price' => 6.5, 'description' => null],
            ['category' => 'KINDERMENUS', 'number' => null, 'suffix' => 'K4', 'name' => 'Kinder Bami of Nasi met saté (2st.) en ei', 'price' => 6.5, 'description' => null],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R1', 'name' => 'Indische rijsttafel (voor 1 persoon)', 'price' => 16.4, 'description' => 'Gado gado, Foe Yong Hai, saté, Daging Roedjak, Daging Smoor, Ajam Ketjap, Atjar, Pisang Goreng, Pindas en Cocos'],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R2', 'name' => 'Indische rijsttafel Vanaf 2 personen... Per persoon', 'price' => 15.0, 'description' => 'Ajam Ketjap, Gado Gado, Daging Smoor, Kroepoek, Daging Roedjak, Foe Yong Hai, Saté, Sambal Goreng Boontjes, Sambal Goreng Kering, Atjar, Pisang Goreng, Pinda en Cocos'],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R3', 'name' => 'Chinese Indische Rijsttafel Vanaf 4 personen... per persoon', 'price' => 16.5, 'description' => 'Foe Yong Hai, Babi Pangang, Tjap Tjoy, Koe Loe Yuk, Ajam Ketjap, Daging Smoor, Daging Roedjak, Saté, Ei, Kroepoek, Sambal Goeren boontjes, Atjar, Pisang Goreng, Pinda en Cocos'],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R4', 'name' => 'Chinese Rijsttafel Vanaf 2 personen... per persoon', 'price' => 17.0, 'description' => 'Kippen- of Tomatensoep, Tjap Tjoy met kipfilet, Koe Loe Yuk, Gebakken garnalen, Babi Pangang, Foe Yong Hai, saté, kroepoek'],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R5', 'name' => 'Kantones Rijsttafel Vanaf 2 personen... per persoon', 'price' => 23.0, 'description' => 'Wan Tan soep, Chinese Dim Sum (mini loempia, kerrie ko, pangsit goreng, garnalen, pasteitje), Geroosterde Peking Eend, Lychee Kai (licht gebraden kipfilet met lychee in zoetzure saus), Tau Sie Haa (garnalen met zwarte bonensaus)'],
            ['category' => 'RIJSTTAFELS', 'number' => null, 'suffix' => 'R6', 'name' => 'Sze Chuan Rijsttafel Vanaf 2 personen... per persoon', 'price' => 23.0, 'description' => 'Peking Soep (pittige lichtzure soep), Chinese Dim Sum (mini loempia, kerrie ko, pangsit goreng, garnalen, pastei(tje), Tjieuw Yem Kai (licht gebakken kipfilet met zout en peper), Lychee Yuk (licht gebraden varkensvlees met lychee in zoetzure saus), Yu Sian Ngau Yuk (ossenhaas met licht zoet pikante kruiden saus)'],
            ['category' => 'BUFFET', 'number' => null, 'suffix' => null, 'name' => 'Buffet Menu A, per persoon', 'price' => 12.8, 'description' => 'Mini Loempia\'s, Pisang Goreng, Babi Pangang, Koe Loe Yuk, Foe Yong Hai, Kipfilet met zwarte bonensaus, Tjap Tjoy met kipfilet, saté Ajam'],
            ['category' => 'BUFFET', 'number' => null, 'suffix' => null, 'name' => 'Buffet Menu B, per persoon', 'price' => 15.0, 'description' => 'Mini Loempia\'s, Pisang Goreng, Babi Pangang, Foe Yong Hai, Kung Bao Kai, Hong Shau Yu, saté Ajam, Ossenhaas met zwarte bonensaus, Kipfilet met kerriesaus'],
            ['category' => 'DIVERSEN', 'number' => null, 'suffix' => null, 'name' => 'Bami of Nasi Goreng ipv rijst', 'price' => 0.9, 'description' => null],
            ['category' => 'DIVERSEN', 'number' => null, 'suffix' => null, 'name' => 'Mihoen Goreng ipv rijst', 'price' => 2.5, 'description' => null],
            ['category' => 'DIVERSEN', 'number' => null, 'suffix' => null, 'name' => 'Chinese Bami ipv rijst', 'price' => 2.5, 'description' => null],
        ];

        foreach ($items as $item) {
            MenuItem::updateOrCreate(
                ['number' => $item['number'], 'suffix' => $item['suffix'], 'name' => $item['name']],
                [
                    'menu_category_id' => $categories[$item['category']]->id,
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'is_active' => true,
                ]
            );
        }

        $riceOptions = [
            ['name' => 'Witte rijst', 'extra_price' => 0, 'sort_order' => 10],
            ['name' => 'Nasi of bami goreng', 'extra_price' => 0.90, 'sort_order' => 20],
            ['name' => 'Mihoen goreng', 'extra_price' => 2.50, 'sort_order' => 30],
            ['name' => 'Chinese bami', 'extra_price' => 2.50, 'sort_order' => 40],
        ];

        foreach ($riceOptions as $option) {
            RiceOption::updateOrCreate(['name' => $option['name']], $option + ['is_active' => true]);
        }
    }
}
