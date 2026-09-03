<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_events', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('name');
            $table->string('location');
            $table->enum('type', ['Latihan', 'Touring', 'Kompetisi', 'Kopdar'])->default('Latihan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_events');
    }
};
