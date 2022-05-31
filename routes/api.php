<?php

use Illuminate\Support\Facades\Route;
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

Route::post('auth/login', 'Api\AuthController@login');

Route::group([
    'middleware' => 'api.jwt'
], function(){

    /** Auth */
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('logout', 'Api\AuthController@logout');
        Route::post('refresh', 'Api\AuthController@refresh');
        Route::post('me', 'Api\AuthController@me');
    });

    Route::apiResource('products', 'Api\ProductController');
    Route::apiResource('categories', 'Api\CategoryController');
    Route::apiResource('sub_categories', 'Api\SubCategoryController');
    Route::apiResource('child_categories', 'Api\ChildCategoryController');
    Route::apiResource('brands', 'Api\BrandController');
    Route::apiResource('orders', 'Api\OrderController');

});

/*
    Public MELI API Routes. This is where Meli sends all notifications for us.
*/
Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('meli_callback', 'Api\MeliController@callback');
    Route::post('meli_notifications', 'Api\MeliController@notifications');
});

Route::group([
    'prefix' => 'pay42'
], function () {
    Route::post('pix-notifications','Front\Pay42PixController@notify');
    Route::post('billet-notifications','Front\Pay42BilletController@notify');
});

