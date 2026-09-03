<?php

namespace Database\Seeders;

use App\Models\ScheduleEvent;
use Illuminate\Database\Seeder;

class ScheduleEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['event_date' => '2026-09-06', 'name' => 'Trabas Rutin Mingguan', 'location' => 'Basecamp Tumpang, Malang', 'type' => 'Latihan'],
            ['event_date' => '2026-09-20', 'name' => 'Susur Kali Brantas', 'location' => 'Kepanjen, Malang', 'type' => 'Touring'],
            ['event_date' => '2026-10-04', 'name' => 'JavaEnduro Adventure Cup 2026', 'location' => 'Lereng Bromo, Kab. Malang', 'type' => 'Kompetisi'],
            ['event_date' => '2026-10-18', 'name' => 'Kopdar & Servis Bareng', 'location' => 'Basecamp Tumpang, Malang', 'type' => 'Kopdar'],
        ];

        foreach ($events as $event) {
            ScheduleEvent::updateOrCreate(
                ['name' => $event['name'], 'event_date' => $event['event_date']],
                $event
            );
        }
    }
}
