<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_posters', function (Blueprint $table) {
            $table->enum('category', ['Baksos Adventure', 'Event Trabas'])->default('Event Trabas')->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('event_posters', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
