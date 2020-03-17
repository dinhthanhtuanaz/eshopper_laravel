<?php

namespace App\Providers;

use App\Model\Brand;
use App\Model\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();
        $brands = Brand::where('status', 1)->orderBy('name')->get();
        $data = array(
            'categories' => $categories,
            'brands' => $brands
        );

        view()->share('SHARED_DATA', $data);
    }
}
