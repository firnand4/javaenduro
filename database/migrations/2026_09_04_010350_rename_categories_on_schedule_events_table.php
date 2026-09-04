<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SQLite menyimpan enum sebagai CHECK constraint yang tidak bisa diubah langsung
     * tanpa doctrine/dbal, jadi tabel dibangun ulang dengan nama kategori baru.
     */
    public function up(): void
    {
        Schema::create('schedule_events_new', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('name');
            $table->string('location');
            $table->enum('category', ['Open Trip Trabas Javaenduro', 'Trabas Baksos Adventure', 'Race Adventure'])->default('Race Adventure');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO schedule_events_new (id, event_date, name, location, category, created_at, updated_at)
            SELECT id, event_date, name, location,
                CASE category
                    WHEN 'Open Trip Trabas' THEN 'Open Trip Trabas Javaenduro'
                    WHEN 'Baksos Adventure' THEN 'Trabas Baksos Adventure'
                    WHEN 'Event Trabas' THEN 'Race Adventure'
                    ELSE 'Race Adventure'
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
            $table->enum('category', ['Open Trip Trabas', 'Baksos Adventure', 'Event Trabas'])->default('Event Trabas');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO schedule_events_old (id, event_date, name, location, category, created_at, updated_at)
            SELECT id, event_date, name, location,
                CASE category
                    WHEN 'Open Trip Trabas Javaenduro' THEN 'Open Trip Trabas'
                    WHEN 'Trabas Baksos Adventure' THEN 'Baksos Adventure'
                    WHEN 'Race Adventure' THEN 'Event Trabas'
                    ELSE 'Event Trabas'
                END,
                created_at, updated_at
            FROM schedule_events
        ");

        Schema::drop('schedule_events');
        Schema::rename('schedule_events_old', 'schedule_events');
    }
};
