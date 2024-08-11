<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');        
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $users = [
            [
                'login'=>'bob',
                'firstname'=>'Bob',
                'lastname'=>'Sull',
                'email'=>'bob@sull.com',
                'password'=>'12345678',
                'langue'=>'fr',
                'created_at'=>'',
                //'role'=>'admin',
            ],
            [
                'login'=>'anna',
                'firstname'=>'Anna',
                'lastname'=>'Lyse',
                'email'=>'anna.lyse@sull.com',
                'password'=>'12345678',
                'langue'=>'en',
                'created_at'=>'',
                //'role'=>'member',
            ],
            [
                'login'=>'fred',
                'firstname'=>'Fred',
                'lastname'=>'Sull',
                'email'=>'fred@sull.com',
                'password'=>'12345678',
                'langue'=>'fr',
                'created_at'=>'',
                //'role'=>'admin',
            ],
        ];
        
        foreach($users as &$user) {
            $user['email_verified_at'] = Carbon::now()->toDateTimeString();    //date('Y-m-d G:i:s');
            $user['created_at'] = Carbon::now()->toDateTimeString();    //date('Y-m-d G:i:s');
            $user['password'] = Hash::make($user['password']);
            $user['remember_token'] = Str::random(10);
        }

        //Insert data in the table
        DB::table('users')->insert($users);        

        //Add 20 randomly generated users
        User::factory(20)->create();
    }
}
