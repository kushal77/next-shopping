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

Route::post('/login', ['as' => 'login', 'uses' => 'Api\LoginApiController@login']);

Route::post('/register', ['as' => 'register', 'uses' => 'Api\LoginApiController@register']);

Route::group(['namespace' => 'Api'], function() {
    require 'Api/home.php';

    require 'Api/category.php';

    require 'Api/product.php';

    require 'Api/banner.php';

    require 'Api/contact.php';

    require 'Api/cart.php';
});

Route::group(['middleware' => ['jwt.verify'], 'namespace' => 'Api'], function() {
	require 'Api/profile.php';
	require 'Api/order.php';
});
Route::get('profile/get_regions_states', 'Api\ProfileController@getRegionsStates');
Route::post('profile/update_data', 'Api\ProfileController@updateData');
