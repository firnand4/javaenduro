<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('graphic_caption');
        });
    }

    public function down(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
