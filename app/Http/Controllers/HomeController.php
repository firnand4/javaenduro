<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\EventPoster;
use App\Models\GalleryItem;
use App\Models\ScheduleEvent;
use App\Models\TrailRoute;
use Illuminate\Support\Str;

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
            ['id' => 'event-trabas', 'label' => 'Jadwal Event Trabas'],
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

        // Dikelompokkan per kategori untuk section "Jadwal Event Trabas" — tiap grup sudah
        // terurut tanggal terdekat lebih dulu karena query di bawah order by event_date.
        $eventPosters = EventPoster::approved()->orderBy('event_date')->get();
        $eventPostersByCategory = $eventPosters->groupBy('category');

        $roadbookByCategory = $this->buildRoadbook($schedule, $eventPosters);

        $contacts = [
            ['label' => 'WhatsApp', 'sub' => '+62 81333413109', 'href' => 'https://wa.me/6281333413109'],
            ['label' => 'Instagram', 'sub' => '@javaenduro', 'href' => 'https://instagram.com/javaenduro'],
            ['label' => 'TikTok', 'sub' => '@javaenduro', 'href' => 'https://tiktok.com/@javaenduro'],
            ['label' => 'Email', 'sub' => 'javaenduro.24@gmail.com', 'href' => 'mailto:javaenduro.24@gmail.com'],
        ];

        return view('welcome', compact(
            'menu', 'stats', 'about', 'nextEvent', 'routes', 'roadbookByCategory', 'gallery', 'eventPostersByCategory', 'contacts'
        ));
    }

    /**
     * Section "Roadbook Musim Ini" mengambil dari dua sumber berbeda tergantung kategori —
     * event resmi (ScheduleEvent, dikelola admin) atau poster kontributor yang sudah divalidasi
     * (EventPoster). Di sini keduanya diseragamkan jadi satu bentuk baris: status, judul, lokasi,
     * tanggal — lalu dibatasi 5 yang paling dekat ke hari ini (bisa yang baru lewat atau akan datang).
     */
    private function buildRoadbook($schedule, $eventPosters): array
    {
        $today = today();
        $roadbook = [];

        foreach (ScheduleEvent::CATEGORIES as $category) {
            $isPosterCategory = in_array($category, EventPoster::CATEGORIES, true);

            $items = $isPosterCategory
                ? $eventPosters->where('category', $category)->map(fn (EventPoster $poster) => [
                    'date' => $poster->event_date,
                    'date_label' => $poster->date_label,
                    'title' => $poster->display_title,
                    'location' => $poster->location_label,
                    'is_upcoming' => $poster->is_upcoming,
                    'status_label' => $poster->event_status_label,
                ])
                : $schedule->where('category', $category)->map(fn (ScheduleEvent $event) => [
                    'date' => $event->event_date,
                    'date_label' => $event->date_label,
                    'title' => $event->name,
                    'location' => $event->location,
                    'is_upcoming' => $event->is_upcoming,
                    'status_label' => $event->event_status_label,
                ]);

            $nearestFive = $items
                ->sortBy(fn (array $item) => $today->diffInDays($item['date']))
                ->take(5)
                ->values();

            $roadbook[$category] = [
                'items' => $nearestFive,
                'total' => $items->count(),
                'seeAllUrl' => $isPosterCategory ? '#poster-' . Str::slug($category) : null,
            ];
        }

        return $roadbook;
    }
}
