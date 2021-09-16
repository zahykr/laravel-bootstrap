<?php

use App\Mail\WelcomeMail;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

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
    return view ('welcome');
});



/* les routes de circuits */
Route::group(['middleware' => ['auth']], function(){
Route::get('/booking','CircuitController@index')->name('circuits.index');
Route::get('/booking/{slug}','CircuitController@show')->name('circuits.show');
Route::get('/search','CircuitController@search')->name('circuits.search');
});
/* routes de cart */
Route::group(['middleware' => ['auth']], function(){
Route::get('/selection','CartController@index')->name('cart.index');
Route::post('/selection/ajouter', 'CartController@store')->name('cart.store');
Route::PATCH('/selection/{$rowId}', 'CartController@update')->name('cart.update');
Route::delete('/selection/{rowId}', 'CartController@destroy')->name('cart.destroy');
Route::get('/videselection', function(){
    Cart::destroy();
});

});
/* paiement routs */
Route::group(['middleware' => ['auth']], function(){
Route::get('/paiement','CheckoutController@index')->name('checkout.index');
Route::post('/paiement','CheckoutController@store')->name('checkout.store');
Route::get('/merci','CheckoutController@thankyou')->name('checkout.thankyou');

});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
