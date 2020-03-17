<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//BackEnd Route
use Illuminate\Support\Facades\Route;
Route::get('admin/login', 'AdminController@showLoginForm');
Route::post('admin/login', 'AdminController@login')->name('login.submit');
Route::get('admin/reset', 'AdminController@sendPasswordToEmail');

Route::group(['middleware' => 'checkAdmin', 'prefix' => 'admin'], function () {
    //Auth + Dashboard
    Route::get("logout", 'AdminController@logout');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'AdminController@showDashboard');
    });
    Route::get('settings', 'AdminController@showSettings');

    //Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index');
        Route::get('/create', 'CategoryController@create');
        Route::post('/create', 'CategoryController@store');
        Route::get('/{id}/edit', 'CategoryController@edit');
        Route::post('/{id}/edit', 'CategoryController@update');
        Route::get('/{id}/delete', 'CategoryController@destroy');

        Route::get('/{id}/{status}', 'CategoryController@changeStatus');
        Route::post('/search', 'CategoryController@search');
        Route::get('/search', 'CategoryController@index');
    });

    //Brands
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'BrandController@index');
        Route::get('/create', 'BrandController@create');
        Route::post('/create', 'BrandController@store');
        Route::get('/{id}/edit', 'BrandController@edit');
        Route::post('/{id}/edit', 'BrandController@update');
        Route::get('/{id}/delete', 'BrandController@destroy');
        //Active/Inactive
        Route::get('/{id}/{status}', 'BrandController@changeStatus');
    });

    //Products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index');
        Route::get('/create', 'ProductController@create');
        Route::post('/create', 'ProductController@store');
        Route::get('/{id}/edit', 'ProductController@edit');
        Route::post('/{id}/edit', 'ProductController@update');
        Route::get('/{id}/delete', 'ProductController@destroy');
    });

    //Customers
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', 'CustomerController@index');
        Route::get('/{id}/showInfo', 'CustomerController@showInfo');
        Route::get('/{id}/showCarts', 'CustomerController@showCarts');
    });

    //Orders - Carts
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', 'CartController@showOrders');
    });
});

//===============FrontEnd Route==============
Route::get('', 'HomeController@index')->name('home');
Route::get('danh-muc/{slug}', 'CategoryController@showProductsByCategory')
        ->name('products-by-category');
Route::get('thuong-hieu/{slug}', 'BrandController@showProductsByBrand')
        ->name('products-by-brand');
Route::get('chi-tiet-san-pham/{slug}', 'ProductController@showProductDetail')
        ->name('detail-product');

//Cart
Route::get('gio-hang.html', 'CartController@showCart')->name('cart');
Route::get('thanh-toan.html', 'CartController@showPaymentForm')
    ->name('payment-form')->middleware('checkCustomerForPayment');
Route::post('thanh-toan.html', 'CartController@payCart')->name('pay-cart');
Route::post('them-san-pham', 'CartController@addProductToCart')->name('add-product');
Route::get('xoa-gio-hang', 'CartController@removeCart')->name('remove-cart');
Route::post('cap-nhat-gio-hang','CartController@updateOneCart')->name('update-cart');
Route::get('xoa-san-pham','CartController@deleteOneCart')->name('delete-item-cart');


//Customers
Route::post('dang-ky', 'CustomerController@signUp')->name('signUp');
Route::post('dang-nhap', 'CustomerController@login')->name('login');
Route::get('dang-xuat.html', 'CustomerController@logout')->name('logout');
//Login/Logout
Route::get('dang-nhap.html', 'CustomerController@showLoginForm')
    ->name('login-form');
Route::get('cap-nhat.html', 'CustomerController@showUpdateForm')->middleware('checkLogged');
Route::post('doi-mat-khau.html', 'CustomerController@changePassword')->name('change-password');
Route::post('cap-nhat.html', 'CustomerController@changeInfo')->name('change-info');
Route::get('lay-mat-khau.html', 'CustomerController@showForgotPasswordForm');
Route::post('lay-mat-khau.html', 'CustomerController@sendPasswordToEmail')->name('send-pass');
//Posts
Route::get('bai-viet.html', function(){
    return view("pages.post_list");
});
Route::get('bai-viet/chi-tiet.html',function(){
    return view("pages.post_detail");
});



//Contact
Route::get('lien-he.html', function(){
    return view("pages.contact_us");
});

//404 page
Route::get('khong-tim-thay.html', function(){
    return view("pages.404_page");
});
