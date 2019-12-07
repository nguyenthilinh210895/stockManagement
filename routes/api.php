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
Route::post('/edit-account', 'Api\UserApiController@editAccount')->name('user.editAccount');
Route::get('showProfile/{email}', 'Api\UserApiController@showProfile')->name('api.showProfile');

Route::resource('products', 'Api\ProductApiController')->except(['create', 'edit']);
Route::resource('inputs', 'Api\InputWareApiController')->except(['create', 'edit']);
