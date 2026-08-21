<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Tampilkan landing page JavaEnduro — komunitas trabas Malang, Jawa Timur.
     */
    public function index()
    {
        $menu = [
            ['id' => 'beranda', 'label' => 'Beranda'],
            ['id' => 'tentang', 'label' => 'Tentang'],
            ['id' => 'rute', 'label' => 'Rute & Trek'],
            ['id' => 'jadwal', 'label' => 'Jadwal'],
            ['id' => 'galeri', 'label' => 'Galeri'],
            ['id' => 'komunitas', 'label' => 'Komunitas'],
            ['id' => 'kontak', 'label' => 'Kontak'],
        ];

        $stats = [
            ['num' => '1.480+', 'label' => 'KM jalur terpetakan'],
            ['num' => '102', 'label' => 'Rider aktif'],
            ['num' => '26', 'label' => 'Event / tahun'],
            ['num' => '6', 'label' => 'Gunung dijelajahi'],
        ];

        $nextEvent = [
            'route' => 'Susur Kali Brantas',
            'date' => '20 Sep 2026',
            'meeting_point' => 'Basecamp Tumpang, Malang',
            'level' => 'Menengah–Ekstrem',
        ];

        $routes = [
            [
                'name' => 'Lereng Semeru',
                'difficulty' => 'Menengah',
                'difficulty_class' => '',
                'distance' => '20 KM',
                'elevation' => '2.100 MDPL',
                'desc' => 'Tanjakan pasir vulkanik khas kaki Mahameru, berat di gas tapi ringan di grip. Sunrise dari pos terakhir jadi bayaran paling mahal.',
                'paths' => ['M3 20 L9 8 L13 15 L16 10 L21 20 Z'],
            ],
            [
                'name' => 'Susur Kali Brantas',
                'difficulty' => 'Ekstrem',
                'difficulty_class' => 'ext',
                'distance' => '13 KM',
                'elevation' => '7x Penyeberangan',
                'desc' => 'Arus deras di musim hujan, dasar berbatu licin sepanjang tahun. Wajib konvoi, wajib winch, dan wajib rider yang tahu kapan harus berhenti.',
                'paths' => ['M2 15c2-2 4-2 6 0s4 2 6 0 4-2 6 0', 'M2 19c2-2 4-2 6 0s4 2 6 0 4-2 6 0'],
            ],
            [
                'name' => 'Hutan Pinus Cangar',
                'difficulty' => 'Pemula',
                'difficulty_class' => '',
                'distance' => '8 KM',
                'elevation' => '1.500 MDPL',
                'desc' => 'Akar pinus dan tanah gembur berkabut dekat pemandian air panas Cangar. Trek favorit untuk latihan keseimbangan rider baru.',
                'paths' => ['M4 4v16M4 4l14 5-14 5'],
            ],
            [
                'name' => 'Punggungan Kawi',
                'difficulty' => 'Ekstrem',
                'difficulty_class' => 'ext',
                'distance' => '22 KM',
                'elevation' => '2.300 MDPL',
                'desc' => 'Jalur batu dan jurang tipis di kanan-kiri menuju punggungan. Bukan trek buat gengsi-gengsian — ini trek buat yang siap turun dorong motor.',
                'paths' => ['M3 18 L7 6 L11 14 L15 4 L21 18 Z'],
            ],
        ];

        $schedule = [
            ['date' => '06 SEP', 'name' => 'Trabas Rutin Mingguan', 'location' => 'Basecamp Tumpang, Malang', 'type' => 'Latihan'],
            ['date' => '20 SEP', 'name' => 'Susur Kali Brantas', 'location' => 'Kepanjen, Malang', 'type' => 'Touring'],
            ['date' => '04 OKT', 'name' => 'JavaEnduro Adventure Cup 2026', 'location' => 'Lereng Bromo, Kab. Malang', 'type' => 'Kompetisi'],
            ['date' => '18 OKT', 'name' => 'Kopdar & Servis Bareng', 'location' => 'Basecamp Tumpang, Malang', 'type' => 'Kopdar'],
        ];

        $gallery = [
            ['class' => 't1', 'icon' => 'climb', 'caption' => 'Lumpur Lereng Semeru'],
            ['class' => 't2', 'icon' => 'forest', 'caption' => 'Hutan Pinus Cangar'],
            ['class' => 't3', 'icon' => 'sunset', 'caption' => 'Sunset Punggungan Kawi'],
            ['class' => 't4', 'icon' => 'convoy', 'caption' => 'Konvoi Pagi Tumpang'],
            ['class' => 't5', 'icon' => 'river', 'caption' => 'Nyemplung Kali Brantas'],
            ['class' => 't6', 'icon' => 'volcano', 'caption' => 'Pasir Vulkanik Bromo'],
            ['class' => 't7', 'icon' => 'camp', 'caption' => 'Basecamp Tumpang'],
            ['class' => 't8', 'icon' => 'trophy', 'caption' => 'Adventure Cup 2025'],
        ];

        $joinSteps = [
            ['title' => 'Follow & DM', 'desc' => 'Sapa kami di Instagram, ceritakan motor dan jam terbang trabas kamu — pemula pun welcome.'],
            ['title' => 'Ikut Kopdar', 'desc' => 'Datang ke kopdar terdekat di Basecamp Tumpang, Malang. Kenalan dulu sebelum turun trek bareng.'],
            ['title' => 'Turun Trabas Rutin', 'desc' => 'Ikut trabas rutin mingguan dengan pendamping rider senior sampai kamu siap trek ekstrem.'],
        ];

        $contacts = [
            ['label' => 'WhatsApp Komunitas', 'sub' => '+62 812-3456-7890', 'href' => 'https://wa.me/6281234567890'],
            ['label' => 'Instagram', 'sub' => '@javaenduro', 'href' => 'https://instagram.com/javaenduro'],
            ['label' => 'Email', 'sub' => 'halo@javaenduro.id', 'href' => 'mailto:halo@javaenduro.id'],
        ];

        return view('welcome', compact(
            'menu', 'stats', 'nextEvent', 'routes', 'schedule', 'gallery', 'joinSteps', 'contacts'
        ));
    }
}
