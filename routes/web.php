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

Route::get('/','ProductController@index')->name('product');;
Route::get('/show/{id}','ProductController@show');
Route::post('/product/addComment','CommentController@store');
Route::post('/product/raiting','RaitingController@store');
Route::get('/admin','Admin\\AdminController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories/{id}','ProductController@getCategories');
Route::get('/addToCart/{id}','ProductController@addToCart');
Route::get('/shoppingCart','ProductController@getCart');
Route::get('/reduce/{id}','ProductController@getReduceByOne');
Route::get('/remove/{id}','ProductController@getRemoveItem');
Route::get('/forget','ProductController@getForget');

Route::group(['prefix' => 'admin'],  function () {
    Route::get('', 'Admin\\AdminController@index');
    Route::resource('products','Admin\\ProductController');
});

Route::get('/checkout','ProductController@checkout')->name('checkout')->middleware('auth');
Route::post('/checkout','ProductController@postCheckout');
Route::get('/user/profile/','ProductController@getProfile');