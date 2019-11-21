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

Route::get('/','HomeController@welcome')->name('/');
Auth::routes();
Route::get('/seller/register','UserController@sellerRegister')->name('seller.register');
Route::get('/home/product-details/{product}','ProductController@show')->name('product.details');
Route::post('/add-to-cart/{product}', 'OrderController@addCart')->name('cart.add');
Route::patch('/update-cart/{product}', 'OrderController@updateCart')->name('cart.update');
Route::delete('/delete-cart/{product}', 'OrderController@destroyCart')->name('cart.delete');
Route::get('/cart', 'OrderController@showCart')->name('cart.show');

Route::middleware(['admin'])->group(function (){
    Route::get('/admin/dashboard','UserController@adminIndex')->name('admin.index');
    Route::get('/admin/seller-list','UserController@allSeller')->name('activeseller.list');
    Route::get('/admin/Inactive-seller-list','UserController@allInactiveSeller')->name('inactiveseller.list');
    Route::get('/admin/all-seller-list','UserController@allSellerLIst')->name('admin.sellerList');
    Route::get('/admin/profile/{user}','UserController@adminProfile')->name('admin.profile');
    Route::get('/admin/profile-edit/{user}','UserController@editAdmin')->name('admin.profileEdit');
    Route::get('/admin/show-product/{user}','ProductController@productShowAdmin')->name('admin.showPorduct');
    //patch methods
    Route::patch('admin/seller/{user}/active','UserController@activeSeller')->name('active.seller');
    Route::patch('admin/seller/{user}/deactive','UserController@deactiveSeller')->name('deactive.seller');
    Route::patch('admin/profile-update/{user}','UserController@updateAdmin')->name('admin.update');
    Route::delete('admin/delete-product/{product}','ProductController@delete')->name('admin.deleteproduct');
});

Route::middleware(['seller','sellerActive'])->group(function (){
    //get methods
    Route::get('/seller/dashboard','UserController@sellerIndex')->name('seller.index');
    Route::get('/product-category/all','ProductCategoryController@index')->name('category.index');
    Route::get('/product-category/edit/{category}','ProductCategoryController@edit')->name('category.edit');
    Route::get('/product-add-product','ProductController@index')->name('product.add');
    Route::get('seller/product-show/{user}','ProductController@productShowseller')->name('seller.product');
    Route::get('seller/product-edit/{product}','ProductController@edit')->name('product.edit');
    Route::get('seller/profile/{user}','UserController@sellerProfile')->name('seller.profile');
    Route::get('/seller/profile-edit/{user}','UserController@editSeller')->name('seller.profileEdit');

    //post methods
    Route::post('/product-category/all','ProductCategoryController@store')->name('category.add');
    Route::post('/product-add-product','ProductController@create')->name('product.store');
    Route::post('/product-image-add','ImageController@create')->name('image.create');
    //post delete
    Route::delete('/product-category/delete/{category}','ProductCategoryController@destroy')->name('category.delete');
    Route::delete('/product-image/delete/{image}','ProductController@destroy')->name('image.delete');
    //post patch
    Route::patch('/product-category/update/{category}','ProductCategoryController@update')->name('category.update');
    Route::delete('/product/delete/{product}','ProductController@delete')->name('product.delete');
    Route::patch('seller/profile-update/{user}','UserController@updateSeller')->name('seller.update');
    Route::patch('seller/product-update/{product}','ProductController@store')->name('product.update');
});
Route::get('/seller/inactive','UserController@sellerInactive')->name('seller.inactive')->middleware('seller');

Route::middleware(['user','auth'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/checkout/{lat}/{lon}', 'OrderController@userCheckout')->name('user.checkout');
    Route::post('/user/order/place', 'OrderController@store')->name('user.order.place');
});
