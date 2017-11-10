<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Special Offers

Route::get('special-offers', 'SpecialOfferController@index');
Route::get('special-offers/{specialOffer}', 'SpecialOfferController@show');
Route::post('special-offers', 'SpecialOfferController@store');
Route::put('special-offers/{specialOffer}', 'SpecialOfferController@update');
Route::delete('special-offers/{specialOffer}', 'SpecialOfferController@delete');
//Route::apiResource('special-offers', 'PhotoController');


//Recipients

Route::get('recipients', 'RecipientController@index');
Route::get('recipients/{recipient}', 'RecipientController@show');
Route::post('recipients', 'RecipientController@store');
Route::put('recipients/{recipient}', 'RecipientController@update');
Route::delete('recipients/{recipient}', 'RecipientController@delete');

//Voucher Code

Route::get('voucher-codes', 'VoucherCodeController@index');
Route::get('voucher-codes/:code', 'VoucherCodeController@show');
Route::post('voucher-codes', 'VoucherCodeController@store');
Route::post('voucher-codes/redeem', 'VoucherCodeController@redeem');
Route::delete('voucher-codes/:code', 'VoucherCodeController@delete');
