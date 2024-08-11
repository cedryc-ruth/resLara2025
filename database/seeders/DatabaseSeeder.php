<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArtistSeeder::class,
            UserSeeder::class,
            TypeSeeder::class,
            PriceSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,            
            LocalitySeeder::class,
            ReservationSeeder::class,
            LocationSeeder::class,
            ShowSeeder::class,
            ArtistTypeSeeder::class,
            RepresentationSeeder::class,
            ArtistTypeShowSeeder::class,
            PriceShowSeeder::class,
            RepresentationReservationSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
