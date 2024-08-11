<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [];

        //Retrieve the 20 users previously created randomly by UserFactory (See DatabaseSeeder)
        $users = User::all();

        //Every user is a member
        foreach($users as $user) {
            $data[] = [
                'user_id' => $user->id,
                'role_role' => 'member',
            ];
        }

        //Define 2 admins
            //Search the users with the login bob & fred
        $bob = User::firstWhere('login','bob');
        $fred = User::firstWhere('login','fred');
        
        $data[] = [
            'user_id' => $bob->id,
            'role_role' => 'admin',
        ];
        
        $data[] = [
            'user_id' => $fred->id,
            'role_role' => 'admin',
        ];

        //Define 5 press critics
            //Retrieve the next 5 users except admin
        $critics = User::offset(3)->limit(5)->get();
        
        foreach($critics as $critic) {
            $data[] = [
                'user_id' => $critic->id,
                'role_role' => 'press',
            ];
        }

        //Define 3 affiliated website
            //Retrieve the next 3 users except admin & press
        $affiliates = User::offset(8)->limit(3)->get();
    
        foreach($affiliates as $affiliate) {
            $data[] = [
                'user_id' => $affiliate->id,
                'role_role' => 'affiliate',
            ];
        }

        //Prepare the data
        foreach ($data as &$row) {
            //Search the role for a given role name
            $role = Role::firstWhere('role',$row['role_role']);
            unset($row['role_role']);
            
            $row['role_id'] = $role->id;
        }
        unset($row);

        //Insert data in the table
        DB::table('role_user')->insert($data);
    }
}
