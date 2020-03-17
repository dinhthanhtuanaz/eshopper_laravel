<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=1; $i<=30; $i++){
            $product = new Product();
            $product->name = "SP " . $faker->name;
            $product->slug = str_slug($product->name);
            $product->category_id = $faker->numberBetween(1,15);
            $product->brand_id = $faker->numberBetween(1,15);
            $product->desc = $faker->text();
            $product->content = $faker->text();
            $product->price = $faker->numberBetween(100000,1000000);
            $product->image = "dien-thoai-samsung-galaxy-s20-1583855526.png";
            $product->save();
        }
    }
}
