<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PowerCloudSoapController;
use App\Http\Controllers\API\PowerCloudRestController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\BackendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    /* Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */
    Route::controller(BackendController::class)->group(function () {
        Route::get('/dashboard', 'getOrders')->name('dashboard');
    });
    Route::controller(BackendController::class)->group(function () {
        Route::get('/backend', 'getOrders')->name('getOrders');
    });
});

Route::get('/hi', function () {
    return view('hi');
});


Route::controller(PowerCloudRestController::class)->group(function () {
    Route::get('/test', 'test')->name('getContract');
    Route::get('/orderTest', 'newOrderTest')->name('newOrderTest');
    Route::get('/getTariffsByCampaign/{campaign}', 'getTariffsByCampaign')->name('getTariffsByCampaign');
    Route::get('/getProducts', 'getProducts')->name('getProducts');
    Route::get('/getProductsById', 'getProductsById')->name('getProductsByID');
});


Route::controller(PowerCloudSoapController::class)->group(function () {
    Route::get('/getTariffs/{zip}/{usage}/{business}', 'getTariffs')->name('getTariffs');
    Route::post('/client/checkout', 'checkout')->name('checkout');
    Route::get('/client/getCityDropdown/{zip}', 'getCityDropdown')->name('getCityDropdown');
});

Route::controller(DispatcherController::class)->group(function () {
    Route::get('/client/{client}', 'start')->name('start');
    Route::get('/client/{client}/about', 'about')->name('about');
    Route::post('/client/{client}/tariff', 'getTariffsPage')->name('getTariff');
    Route::post('/client/submitForm', 'submitForm')->name('submitForm');
    Route::get('/client/{client}/checkout/success', 'checkoutSuccess')->name('checkoutSuccess');
    Route::get('/client/{client}/getTarifHtml/{zip}/{usage}', 'getTarifHtml')->name('getTarifHtml');

    //Nur für die Kirche
    Route::get('/client/{client}/registrierung/{zip?}/{usage?}', 'register')->name('registerclient');
});



