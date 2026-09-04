<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun admin untuk masuk ke /admin. GANTI PASSWORD INI setelah login pertama.
        User::updateOrCreate(
            ['email' => 'admin@javaenduro.id'],
            [
                'name' => 'Admin JavaEnduro',
                'password' => bcrypt('javaenduro123'),
                'role' => 'superadmin',
            ]
        );

        $this->call([
            TrailRouteSeeder::class,
            ScheduleEventSeeder::class,
            GalleryItemSeeder::class,
            AboutContentSeeder::class,
        ]);
    }
}
