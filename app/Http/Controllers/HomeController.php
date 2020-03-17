<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
class HomeController extends Controller
{
    public function index(){
        $newProducts = Product::orderByDesc('id')->paginate(12);
        $hotProducts = Product::where('hot', 1)->orderByDesc('id')->limit(9)->get();
        $data = array(
            'newProducts' => $newProducts,
            'hotProducts' => $hotProducts
        );
        return view("pages.home", $data);
    }
}
