<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\GalleryItem;
use App\Models\ScheduleEvent;
use App\Models\TrailRoute;

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

        $about = AboutContent::current();
        $routes = TrailRoute::ordered()->get();
        $schedule = ScheduleEvent::upcomingFirst()->get();
        $gallery = GalleryItem::ordered()->get();

        $nextEvent = $schedule->firstWhere('event_date', '>=', today())
            ?? $schedule->first();

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
            'menu', 'stats', 'about', 'nextEvent', 'routes', 'schedule', 'gallery', 'joinSteps', 'contacts'
        ));
    }
}
