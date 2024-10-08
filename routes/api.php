<?php

use App\Http\Controllers\Additional_customizationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaristaController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User_AdditionalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//////Auth/////
    Route::controller(AuthController::class)->group(function () {
        Route::Post('login','login')->name('login');
        Route::Post('register','register')->name('register');
        Route::Post('logout','logout')->middleware('auth:api')->name('logout');
        Route::get('get_profile','get_profile')->middleware('auth:api')->name('get_profile');
        Route::post('rest_pass','rest_pass')->middleware('auth:api')->name('rest_pass');
        Route::post('new_pass','new_pass')->middleware('auth:api')->name('new_pass');


    });
/////////////Store///////////
Route::controller(StoreController::class)->group(function () {
    Route::Post('add_store','add_store')->name('add_store')->middleware('role:admin');
    Route::Post('select_store/{id}','select')->name('select_store');
});

/////////////Coffee///////////
Route::controller(CoffeeController::class)->group(function () {
    Route::Post('add_coffee','add_coffee')->name('add_coffee')->middleware('role:admin');
    Route::get('get_coffees','get_coffees')->name('get_coffees');
});

/////////////Barista///////////
Route::controller(BaristaController::class)->group(function () {
    Route::Post('add_Barista','add_Barista')->name('add_Barista')->middleware('role:admin');
    Route::get('get_Baristas','get_Barista')->name('get_Barista');
});


/////////////additional_customizations///////
Route::controller(Additional_customizationsController::class)->group(function () {
    Route::Post('add_milk','add_milk')->name('add_milk');
    Route::Post('add_additvies','add_additvies')->name('add_additvies');
    Route::Post('add_Syrup','add_Syrup')->name('add_Syrup');
    Route::Post('add_Coffee_type','add_Coffee_type')->name('add_Coffee_type');
    Route::Post('add_Coffee_country','add_Coffee_country')->name('add_Coffee_country');
});


//////////////////////////User_additional_customizations///////////////
    Route::middleware('auth:api')->controller(User_AdditionalController::class)->group(function () {
    Route::get('get_milk','get_milk')->name('get_milk');
    Route::get('get_additvies','get_Additives')->name('get_additvies');
    Route::get('get_Syrup','get_Syrup')->name('get_Syrup');
    Route::get('get_Coffee_type','get_Coffee_type')->name('get_Coffee_type');
    Route::get('get_Coffee_country','get_Coffee_country')->name('get_Coffee_country');
    Route::get('get_additional_customizations','get_additional_customizations')->name('get_additional_customizations');


});

/////////////////orders///////////////////////////
Route::middleware('auth:api')->controller(OrderController::class)->group(function () {

Route::Post('add_order','add_order')->name('add_order');
Route::get('get_orders','get_orders')->name('get_orders');



});


///////////REVIEWS/////
Route::middleware('auth:api')->controller(ReviewController::class)->group(function () {

    Route::Post('add_review/{order_id}','add_review')->name('add_review');});











