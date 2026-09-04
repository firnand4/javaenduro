<?php

namespace Database\Seeders;

use App\Models\ScheduleEvent;
use Illuminate\Database\Seeder;

class ScheduleEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['event_date' => '2026-09-06', 'name' => 'Trabas Rutin Mingguan', 'location' => 'Basecamp Tumpang, Malang', 'category' => 'Open Trip Trabas Javaenduro'],
            ['event_date' => '2026-09-20', 'name' => 'Susur Kali Brantas', 'location' => 'Kepanjen, Malang', 'category' => 'Open Trip Trabas Javaenduro'],
            ['event_date' => '2026-10-04', 'name' => 'JavaEnduro Adventure Cup 2026', 'location' => 'Lereng Bromo, Kab. Malang', 'category' => 'Race Adventure'],
            ['event_date' => '2026-10-18', 'name' => 'Kopdar & Servis Bareng', 'location' => 'Basecamp Tumpang, Malang', 'category' => 'Race Adventure'],
        ];

        foreach ($events as $event) {
            ScheduleEvent::updateOrCreate(
                ['name' => $event['name'], 'event_date' => $event['event_date']],
                $event
            );
        }
    }
}
