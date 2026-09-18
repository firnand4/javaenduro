<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Galeri foto per rute — satu rute bisa punya banyak foto. */
    public function up(): void
    {
        Schema::create('trail_route_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trail_route_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trail_route_photos');
    }
};
