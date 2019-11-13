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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('areas', 'AreaController')->except(['store', 'update','destroy','show']);

Route::resource('warehouses', 'WarehouseController')->except(['store', 'update','destroy','show']);

Route::resource('zones', 'ZoneController')->except(['store', 'update','destroy','show']);

Route::resource('items', 'ItemGroupController')->except(['store', 'update','destroy','show']);
