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
        Schema::create('event_posters_new', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->enum('category', ['Trabas Baksos Adventure', 'Race Adventure'])->default('Race Adventure');
            $table->string('city');
            $table->string('kecamatan')->nullable();
            $table->string('province');
            $table->date('event_date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO event_posters_new (id, user_id, image_path, category, city, kecamatan, province, event_date, status, created_at, updated_at)
            SELECT id, user_id, image_path,
                CASE category
                    WHEN 'Baksos Adventure' THEN 'Trabas Baksos Adventure'
                    WHEN 'Event Trabas' THEN 'Race Adventure'
                    ELSE 'Race Adventure'
                END,
                city, kecamatan, province, event_date, status, created_at, updated_at
            FROM event_posters
        ");

        Schema::drop('event_posters');
        Schema::rename('event_posters_new', 'event_posters');
    }

    public function down(): void
    {
        Schema::create('event_posters_old', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->enum('category', ['Baksos Adventure', 'Event Trabas'])->default('Event Trabas');
            $table->string('city');
            $table->string('kecamatan')->nullable();
            $table->string('province');
            $table->date('event_date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO event_posters_old (id, user_id, image_path, category, city, kecamatan, province, event_date, status, created_at, updated_at)
            SELECT id, user_id, image_path,
                CASE category
                    WHEN 'Trabas Baksos Adventure' THEN 'Baksos Adventure'
                    WHEN 'Race Adventure' THEN 'Event Trabas'
                    ELSE 'Event Trabas'
                END,
                city, kecamatan, province, event_date, status, created_at, updated_at
            FROM event_posters
        ");

        Schema::drop('event_posters');
        Schema::rename('event_posters_old', 'event_posters');
    }
};
