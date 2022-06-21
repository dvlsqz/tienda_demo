<?php

use Illuminate\Support\Facades\Route;

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


// Module Auth
Route::get('/login','ConnectController@getLogin')->name('login');
Route::post('/login','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');
Route::get('/register','ConnectController@getRegister')->name('register');
Route::post('/register','ConnectController@postRegister')->name('register');
Route::get('/recover','ConnectController@getRecover')->name('recover');
Route::post('/recover','ConnectController@postRecover')->name('recover');
Route::get('/reset','ConnectController@getReset')->name('reset');
Route::post('/reset','ConnectController@postReset')->name('reset');

// Module Home
Route::get('/', 'ContentController@getHome')->name('home');

// Module Store
Route::get('/store','StoreController@getStore')->name('store');
Route::get('/store/category/{id}/{slug}','StoreController@getCategory')->name('store_category');
Route::post('/search','StoreController@postSearch')->name('search');

// Module Cart
Route::get('/cart', 'CartController@getCart')->name('cart');
Route::post('/cart', 'CartController@postCart')->name('cart');
Route::post('/cart/product/{id}/add', 'CartController@postCartAdd')->name('cart_add');
Route::post('/cart/item/{id}/update', 'CartController@postCartItemQuantityUpdate')->name('cart_item_update');
Route::get('/cart/item/{id}/delete', 'CartController@getCartItemDelete')->name('cart_item_delete');
Route::get('/cart/{order}/type/{type}', 'CartController@getCartChangeType')->name('cart');

//Module Products
Route::get('/product/{id}/{slug}', 'ProductController@getProduct')->name('product_single');

//Module User
Route::get('/account/edit','UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar','UserController@postAccountAvatar')->name('account_edit_avatar');
Route::post('/account/edit/password','UserController@postAccountPassword')->name('account_edit_password');
Route::post('/account/edit/info','UserController@postAccountInfo')->name('account_edit_info');
Route::get('/account/address','UserController@getAccountAddress')->name('account_address');
Route::post('/account/address/add','UserController@postAccountAddressAdd')->name('account_address');
Route::get('/account/address/{address}/setdefault','UserController@getAccountAddressSetDefault')->name('account_address');
Route::get('/account/address/{address}/delete','UserController@getAccountAddressDelete')->name('account_address');
Route::get('/account/history/orders', 'UserOrderController@getHistory')->name('account_user_orders_history');
Route::get('/account/history/order/{order}', 'UserOrderController@getOrder')->name('account_user_order_details');

//Ajax API Routers
Route::get('/md/api/load/products/{section}', 'ApiJsController@getProductsSection');
Route::post('/md/api/load/user/favorites', 'ApiJsController@postUserFavorites'); 
Route::post('/md/api/favorites/add/{object}/{module}', 'ApiJsController@postFavoritesAdd'); 
Route::post('/md/api/load/product/inventory/{inv}/variants', 'ApiJsController@postProductInventoryVariants'); 
Route::post('/md/api/load/cities/{state}', 'ApiJsController@postCoverageCitiesFronState'); 