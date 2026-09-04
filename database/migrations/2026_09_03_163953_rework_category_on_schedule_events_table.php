<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SQLite menyimpan enum sebagai CHECK constraint yang tidak bisa diubah langsung
     * tanpa doctrine/dbal, jadi tabel dibangun ulang dengan kolom baru "category".
     */
    public function up(): void
    {
        Schema::create('schedule_events_new', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('name');
            $table->string('location');
            $table->enum('category', ['Open Trip Trabas', 'Baksos Adventure', 'Event Trabas'])->default('Event Trabas');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO schedule_events_new (id, event_date, name, location, category, created_at, updated_at)
            SELECT id, event_date, name, location,
                CASE type
                    WHEN 'Latihan' THEN 'Open Trip Trabas'
                    WHEN 'Touring' THEN 'Open Trip Trabas'
                    WHEN 'Kompetisi' THEN 'Event Trabas'
                    WHEN 'Kopdar' THEN 'Event Trabas'
                    ELSE 'Event Trabas'
                END,
                created_at, updated_at
            FROM schedule_events
        ");

        Schema::drop('schedule_events');
        Schema::rename('schedule_events_new', 'schedule_events');
    }

    public function down(): void
    {
        Schema::create('schedule_events_old', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('name');
            $table->string('location');
            $table->enum('type', ['Latihan', 'Touring', 'Kompetisi', 'Kopdar'])->default('Latihan');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO schedule_events_old (id, event_date, name, location, type, created_at, updated_at)
            SELECT id, event_date, name, location, 'Latihan', created_at, updated_at
            FROM schedule_events
        ");

        Schema::drop('schedule_events');
        Schema::rename('schedule_events_old', 'schedule_events');
    }
};
