<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trail_routes', function (Blueprint $table) {
            $table->string('map_image_path')->nullable()->after('description');
            $table->string('teaser_video_path')->nullable()->after('map_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('trail_routes', function (Blueprint $table) {
            $table->dropColumn(['map_image_path', 'teaser_video_path']);
        });
    }
};
