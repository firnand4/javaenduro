<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trail_routes', function (Blueprint $table) {
            // Video teaser bisa dari salah satu: file upload (teaser_video_path) atau link YouTube ini.
            $table->string('teaser_youtube_url')->nullable()->after('teaser_video_path');
        });
    }

    public function down(): void
    {
        Schema::table('trail_routes', function (Blueprint $table) {
            $table->dropColumn('teaser_youtube_url');
        });
    }
};
