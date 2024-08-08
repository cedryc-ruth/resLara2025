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
            LocalitySeeder::class,
            ReservationSeeder::class,
            LocationSeeder::class,
            ShowSeeder::class,
            ArtistTypeSeeder::class,
            RepresentationSeeder::class,
            ArtistTypeShowSeeder::class,
        ]);

        //Créer 1 admin
        User::factory()->create([
            'login' => 'fred',
            'firstname' => 'Fred',
            'lastname' => 'Sull',
            'email' => 'fred@sull.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'langue' => 'fr',
            'role' => 'admin',
        ]);

        //Créer 10 membres
        User::factory(10)->create([
            'role' => 'member',
        ]);

        //Créer 5 critiques de presse
        User::factory(5)->create([
            'role' => 'press',
        ]);

        //Créer 3 sites abonnés
        User::factory(3)->create([
            'role' => 'affiliate',
        ]);
    }
}
