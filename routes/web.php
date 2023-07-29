<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\PowerCloudSoapController;
use App\Http\Controllers\API\PowerCloudRestController;
use App\Http\Controllers\DispatcherController;

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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/hi', function () {
    return view('hi');
});


Route::controller(PowerCloudRestController::class)->group(function () {
    Route::get('/getContract', 'test')->name('getContract'); 
    Route::get('/orderTest', 'newOrderTest')->name('newOrderTest'); 
});

Route::controller(PowerCloudSoapController::class)->group(function () {
     
    Route::get('/getTariffs', 'getTariffs')->name('getTariffs');  
    Route::post('/client/tarife', 'getInfo')->name('getInfo');  
});

Route::controller(DispatcherController::class)->group(function () {
    Route::get('/client/freising', 'start')->name('start'); 
});