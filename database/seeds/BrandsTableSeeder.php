<?php

use App\Model\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
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
            $brand = new Brand();
            $brand->name = "Brand " . $faker->name;
            $brand->slug = str_slug($brand->name);
            $brand->desc = $faker->text();
            $brand->save();
        }
    }
}
