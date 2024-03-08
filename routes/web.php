<?php

use Illuminate\Support\Facades\Route;

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


Route::controller(App\Http\Controllers\IndividualpollingunitController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/polling-unit-results',  'getPollingUnitResults');
    Route::get('/summed-total', 'summedview');
    Route::get('/summed-total-result', 'summed');


    Route::get('/new-polling-unit', 'showNewPollingUnitForm')->name('new-polling-unit');
    Route::post('/new-polling-unit', 'storeNewPollingUnitData')->name('store-new-polling-unit');

});
