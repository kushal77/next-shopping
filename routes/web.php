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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register'=>false]);

Route::group(['prefix' => 'backend', 'as' => 'admin.', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    /** Admin Product Routes **/
    Route::resource('product','ProductController');
    Route::post('product/remove', ['as' => 'product.removeimage', 'uses' => 'ProductController@removeimage']);
    /** Admin Category Routes **/
    Route::resource('category','CategoryController');
    Route::post('/category/customfields', ['as' => 'getcategory.customfields', 'uses' => 'CategoryController@customfields']);
    Route::post('/category/loadcustomfields', ['as' => 'loadcustomfields', 'uses' => 'CategoryController@loadcustomfields']);
    /** Admin Brand Routes **/
    Route::resource('brand','BrandController');
    /** Admin Order Routes **/
    Route::resource('order','OrderController');
    /** Admin Banner Routes **/
    Route::resource('banner','BannerController');
    /** Admin Faq Routes **/
    Route::resource('faq','FaqController');
    /** Admin Coupon Routes **/
    Route::resource('coupon','CouponController');
    /** Admin User Routes **/
    Route::resource('users','UserController');
    Route::get('setting', ['as' => 'setting', 'uses' => 'SettingController@index']);
    Route::post('setting/update', ['as' => 'setting.update', 'uses' => 'SettingController@update']);
    /** Admin Page Routes **/
    Route::resource('page','PageController');
    /** Admin EMI Rates Routes **/
    Route::resource('emi','EmiRateController');
});
/** Admin Login Routes **/
Route::get('/backend/login', ['as' => 'backend.login', 'uses' => 'Admin\LoginController@showLoginForm']);
Route::post('/backend/login', ['as' => 'backend.login', 'uses' => 'Admin\LoginController@login']);

/** Front End Routes **/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::post('/contact/save', ['as' => 'contact.save', 'uses' => 'HomeController@saveContact']);
Route::get('/special-deals', ['as' => 'specialDeals', 'uses' => 'HomeController@specialDeals']);
Route::get('/new-products', ['as' => 'newproducts', 'uses' => 'HomeController@newProducts']);
Route::get('/service', ['as' => 'service', 'uses' => 'HomeController@service']);
Route::get('/faqs', ['as' => 'faqs', 'uses' => 'HomeController@faqs']);
Route::get('/faqs/search', ['as' => 'faqs.search', 'uses' => 'HomeController@searchFaq']);
Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);
Route::get('/category', ['as' => 'category', 'uses' => 'HomeController@category']);
Route::get('/detail', ['as' => 'detail', 'uses' => 'HomeController@detail']);
Route::get('/search',['as' => 'search', 'uses' => 'HomeController@search']);
Route::post('/register',['as' => 'register', 'uses' => 'Auth\RegisterController@register']);
Route::get('/verifyemail/{id}',['as' => 'verifyemail', 'uses' => 'Auth\RegisterController@verifyemail']);
Route::get('/{alias}/product', ['as' => 'view.product', 'uses' => 'ProductController@index']);
Route::get('/{alias}/category', ['as' => 'view.category', 'uses' => 'CategoryController@index']);

Route::get('/{alias}/brand', ['as' => 'view.brand', 'uses' => 'BrandController@index']);

/** Forgot Password Routes **/

Route::get('/forgot-password',['as' => 'forgot-password', 'uses' => 'Auth\ForgotPasswordController@forgotPassword']);

Route::post('/send-reset-password',['as' => 'reset-psw-mail', 'uses' => 'Auth\ForgotPasswordController@sendResetPasswordMail']);

Route::get('/resetPassword/{id}',['as' => 'resetPassword', 'uses' => 'Auth\ResetPasswordController@showResetPassword']);

Route::post('/client/password/reset',['as' => 'client.password.reset', 'uses' => 'Auth\ResetPasswordController@resetPassword']);



/** Front End Ajax Routes */
Route::group(['prefix' => 'ajax'], function () {

    $controller = 'AjaxController';

    Route::post('change-password', $controller . '@changePassword')->name('ajax.change.password');

    Route::post('update-profile', $controller . '@updateProfile')->name('ajax.update.profile');

});

Route::post('/addtocart',['as' => 'addtocart', 'uses' => 'CartController@addtocart']);
Route::get('/cart', ['as' => 'cart', 'uses' => 'CartController@cart']);
Route::post('/removeitemfromcart', ['as' => 'removeitemfromcart', 'uses' => 'CartController@removeitemfromcart']);
Route::post('/updateitemincart', ['as' => 'updateitemincart', 'uses' => 'CartController@updateitemincart']);
Route::post('/addcoupontocart', ['as' => 'addcoupontocart', 'uses' => 'CartController@addcoupontocart']);
Route::get('/checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@index']);
Route::post('/saveorder', ['as' => 'saveorder', 'uses' => 'CheckoutController@saveorder']);
Route::get('/{orderId}/confirm-order', ['as' => 'confirmOrder', 'uses' => 'CheckoutController@confirmOrder']);
Route::get('/{page_slug}', ['as' => 'page', 'uses' => 'HomeController@page']);
Route::post('/getrate', ['as' => 'getrate', 'uses' => 'ProductController@getrate']);
