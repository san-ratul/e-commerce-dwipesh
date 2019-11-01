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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/seller/register','UserController@sellerRegister')->name('seller.register');

Route::middleware(['admin'])->group(function (){
    Route::get('/admin/dashboard','UserController@adminIndex')->name('admin.index');
});

Route::middleware(['seller','sellerActive'])->group(function (){
    //get methods
    Route::get('/seller/dashboard','UserController@sellerIndex')->name('seller.index');
    Route::get('/product-category/all','ProductCategoryController@index')->name('category.index');

    //post methods
    Route::post('/product-category/all','ProductCategoryController@store')->name('category.add');

});
Route::get('/seller/inactive','UserController@sellerInactive')->name('seller.inactive')->middleware('seller');

Route::middleware(['user'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
});
