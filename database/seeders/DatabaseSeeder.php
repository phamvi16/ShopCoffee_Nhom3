<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $fake  = Faker\Factory::create();
        $limit = 5;

        for ($i = 0; $i < $limit; $i++){
            DB::table('topping')->insert([
                'Name' => $fake->name,
                'Price' => 	$fake->numerify($string ='###'),
                'Status' => $fake->sentence
            ]);
        }
    }
}
/*
php artisan db:seed --class=DatabaseSeeder
*/
