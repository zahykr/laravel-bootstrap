<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Special été',
            'slug' => 'special-été'
        ]);

        Category::create([
            'name' => 'Sahara',
            'slug' => 'sahara'
        ]);

        Category::create([
            'name' => 'Nord',
            'slug' => 'nord'
        ]);

        Category::create([
            'name' => 'Sud',
            'slug' => 'sud'
        ]);

        Category::create([
            'name' => 'Djerba',
            'slug' => 'djerba'
        ]);
    }
}