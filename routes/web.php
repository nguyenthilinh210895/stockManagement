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

//Route::get('/', function () {
//    return view('welcome');
//});
$manageRoutes = function () {
    Auth::routes();

    Route::post('adminLogin', 'Api\AuthController@adminLogin')->name('api.adminLogin');

    Route::get('/', function () {return redirect('/manager/home');})->name('admin.dashboard');


    Route::get('login/forget', function () {return view("auth.passwords.forget");})->name('forget');
    //Route::get('login/cannot-login', function () {return view("auth.passwords.cannotLogin");})->name('auth.cannot.login');
    Route::get('logout', 'Api\AuthController@adminLogout')->name('api.adminLogout');
    Route::get('form-reset-password/{token}', 'Api\ResetPasswordController@formReset')->name('formreset');

    //Route::get('password-initial/{email}', function ($email) {return view("auth.passwords.passwordInitial",compact('email'));})->name('password.initial');
    //Route::post('password-inital', 'Api\UserApiController@initialPassword')->name('api.initialPassword');
    //Route::get('set/password-initial/', function() {return redirect()->route('logout');})->name('set.password.initial');

    Route::group(['prefix' => 'manager','middleware' => ['checkLogin']], function () {
        Route::resource('areas', 'AreaController')->except(['store', 'update','destroy','show']);

        Route::resource('warehouses', 'WarehouseController')->except(['store', 'update','destroy','show']);

        Route::resource('zones', 'ZoneController')->except(['store', 'update','destroy','show']);

        Route::resource('items', 'ItemGroupController')->except(['store', 'update','destroy','show']);

        Route::resource('manufacturers', 'ManufacturerController')->except(['store', 'update','destroy','show']);

        Route::resource('qualitys', 'QualityController')->except(['store', 'update','destroy','show','create']);

        Route::resource('calculations', 'CaculationUnitController')->except(['store', 'update','destroy','show','create']);

        Route::resource('users', 'UserController')->except(['store', 'update','destroy','show']);
        Route::get('profile', 'UserController@editProfile')->name('user.profile');

        Route::resource('products', 'ProductController')->except(['store', 'update','destroy','show']);

        Route::get('/home', 'HomeController@index')->name('home');
    });
};


Route::group(['domain' => env('MANAGE_APP_URL')], $manageRoutes);
