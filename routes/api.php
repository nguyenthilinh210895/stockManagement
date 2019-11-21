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

Route::resource('manufacturers', 'Api\ManufacturerApiController')->except(['create', 'edit']);

Route::resource('qualitys', 'Api\QualityApiController')->except(['create', 'edit', 'show', 'update']);

Route::resource('calculations', 'Api\CaculationUnitApiController')->except(['create', 'edit', 'show', 'update']);

Route::resource('users', 'Api\UserApiController')->except(['create', 'edit']);
