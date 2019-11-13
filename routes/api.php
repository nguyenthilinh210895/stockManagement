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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('areas', 'Api\AreaApiControlller')->except(['create', 'edit']);

Route::resource('warehouses', 'Api\WarehouseApiController')->except(['create', 'edit']);

Route::resource('zones', 'Api\ZoneApiController')->except(['create', 'edit']);

Route::resource('items', 'Api\ItemGroupApiController')->except(['create', 'edit']);
