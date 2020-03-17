<?php

use App\Model\Category;
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
        $faker = Faker\Factory::create();
        for($i=1; $i<=15; $i++){
            $category = new Category();
            $category->name = "DM " . $faker->name;
            $category->slug = str_slug($category->name);
            $category->desc = $faker->text();
            $category->save();
        }
    }
}
