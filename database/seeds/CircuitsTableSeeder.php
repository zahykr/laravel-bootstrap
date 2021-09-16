<?php

use App\Circuit;
use Illuminate\Database\Seeder;

class CircuitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for ($i=0; $i <30 ; $i++) { 
            Circuit::create([
               'titre' => $faker->sentence(5),
               'slug' => $faker->slug,
               'sousTitre' => $faker->sentence(4),
               'description' => $faker->text,
               'prix' => $faker->numberBetween(100,1000) *100,
               'image' => 'https://via.placeholder.com/200x250',

            ])->categories()->attach([
                rand(1, 4),
                rand(1, 4)
            ]);
        }
    }
}
