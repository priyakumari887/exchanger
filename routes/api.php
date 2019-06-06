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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// refresh todays exchange rate.
Route::get('refresh_rate', 'ExchangeRate\ExchangeRateController@refreshExchangeRate');

// get all rates
Route::get('rates', 'ExchangeRate\ExchangeRateController@getAllRates');

// CRUD for exchange rate.
Route::resource('exchange_rate', 'ExchangeRate\ExchangeRateController');


