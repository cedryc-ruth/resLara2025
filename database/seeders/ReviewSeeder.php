<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\User;
use App\Models\Show;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Review::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $data = [
            [
                'user_login'=>'bob',
                'show_slug'=>'ayiti',
                'review'=>'Excellent!',
                'stars'=>5,
                'validated'=>true,
            ],
            [
                'user_login'=>'bob',
                'show_slug'=>'manneke',
                'review'=>'Vraiment drôle. On passe un très bon moment.',
                'stars'=>4,
                'validated'=>true,
            ],
            [
                'user_login'=>'bob',
                'show_slug'=>'cible-mouvante',
                'review'=>'Rien compris...',
                'stars'=>1,
                'validated'=>false,
            ],
            [
                'user_login'=>'anna',
                'show_slug'=>'ayiti',
                'review'=>'Intéressant.',
                'stars'=>4,
                'validated'=>true,
            ],
            [
                'user_login'=>'anna',
                'show_slug'=>'cible-mouvante',
                'review'=>'Génial!',
                'stars'=>4,
                'validated'=>false,
            ],
        ];
        
        //Prepare the data
        foreach ($data as &$row) {
            //Search the location for a given location's slug
            $user = User::firstWhere('login',$row['user_login']);
            unset($row['user_login']);

            //Search the show for a given show's slug
            $show = Show::firstWhere('slug',$row['show_slug']);
            unset($row['show_slug']);
            
            $row['user_id'] = $user->id;
            $row['show_id'] = $show->id;
        }
        unset($row);

        //Insert data in the table
        DB::table('reviews')->insert($data);
    }
}
