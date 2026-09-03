<?php

namespace Database\Seeders;

use App\Models\TrailRoute;
use Illuminate\Database\Seeder;

class TrailRouteSeeder extends Seeder
{
    public function run(): void
    {
        $routes = [
            [
                'name' => 'Lereng Semeru',
                'difficulty' => 'Menengah',
                'icon' => 'climb',
                'distance' => '20 KM',
                'elevation' => '2.100 MDPL',
                'description' => 'Tanjakan pasir vulkanik khas kaki Mahameru, berat di gas tapi ringan di grip. Sunrise dari pos terakhir jadi bayaran paling mahal.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Susur Kali Brantas',
                'difficulty' => 'Ekstrem',
                'icon' => 'river',
                'distance' => '13 KM',
                'elevation' => '7x Penyeberangan',
                'description' => 'Arus deras di musim hujan, dasar berbatu licin sepanjang tahun. Wajib konvoi, wajib winch, dan wajib rider yang tahu kapan harus berhenti.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hutan Pinus Cangar',
                'difficulty' => 'Pemula',
                'icon' => 'forest',
                'distance' => '8 KM',
                'elevation' => '1.500 MDPL',
                'description' => 'Akar pinus dan tanah gembur berkabut dekat pemandian air panas Cangar. Trek favorit untuk latihan keseimbangan rider baru.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Punggungan Kawi',
                'difficulty' => 'Ekstrem',
                'icon' => 'sunset',
                'distance' => '22 KM',
                'elevation' => '2.300 MDPL',
                'description' => 'Jalur batu dan jurang tipis di kanan-kiri menuju punggungan. Bukan trek buat gengsi-gengsian — ini trek buat yang siap turun dorong motor.',
                'sort_order' => 4,
            ],
        ];

        foreach ($routes as $route) {
            TrailRoute::updateOrCreate(['name' => $route['name']], $route);
        }
    }
}
