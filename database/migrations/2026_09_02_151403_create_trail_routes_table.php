<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trail_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('difficulty', ['Pemula', 'Menengah', 'Ekstrem'])->default('Menengah');
            $table->string('icon')->default('climb');
            $table->string('distance');
            $table->string('elevation');
            $table->text('description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trail_routes');
    }
};
