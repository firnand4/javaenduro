<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['tile_style' => 't1', 'icon' => 'climb', 'caption' => 'Lumpur Lereng Semeru', 'sort_order' => 1],
            ['tile_style' => 't2', 'icon' => 'forest', 'caption' => 'Hutan Pinus Cangar', 'sort_order' => 2],
            ['tile_style' => 't3', 'icon' => 'sunset', 'caption' => 'Sunset Punggungan Kawi', 'sort_order' => 3],
            ['tile_style' => 't4', 'icon' => 'convoy', 'caption' => 'Konvoi Pagi Tumpang', 'sort_order' => 4],
            ['tile_style' => 't5', 'icon' => 'river', 'caption' => 'Nyemplung Kali Brantas', 'sort_order' => 5],
            ['tile_style' => 't6', 'icon' => 'volcano', 'caption' => 'Pasir Vulkanik Bromo', 'sort_order' => 6],
            ['tile_style' => 't7', 'icon' => 'camp', 'caption' => 'Basecamp Tumpang', 'sort_order' => 7],
            ['tile_style' => 't8', 'icon' => 'trophy', 'caption' => 'Adventure Cup 2025', 'sort_order' => 8],
        ];

        foreach ($items as $item) {
            GalleryItem::updateOrCreate(['caption' => $item['caption']], $item);
        }
    }
}
