<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Reservation;
use App\Models\Price;

class RepresentationReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('representation_reservation')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $data = [];

        $reservations = Reservation::all();
        $representations = Representation::where(['schedule'=>'2012-10-12 20:30'])->get();
        $prices = Price::where(['end_date'=>null])->get();

        //Add a reservation for each representation at a random valid price and a random quantity
        foreach($representations as $repres) {
            foreach($reservations as $res) {
                $data[] = [
                    'representation_id' => $repres->id,
                    'reservation_id' => $res->id,
                    'unit_price' => $prices->random()->price,
                    'quantity' => rand(1,5),
                ];
            }
        }

        //Let's add a reservation for a representation but with different prices
        //Let's add a reservation for multiple representations and the same prices
        //Let's add a reservation for multiple representations but with different prices

        //Insert data in the table
        DB::table('representation_reservation')->insert($data);
    }
}
