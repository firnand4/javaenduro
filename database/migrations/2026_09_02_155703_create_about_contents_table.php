<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singleton: hanya akan pernah ada satu baris (id 1) untuk isi section "Tentang Kami".
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('paragraph_1');
            $table->text('paragraph_2');
            $table->json('value_chips');
            $table->string('graphic_caption');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_contents');
    }
};
