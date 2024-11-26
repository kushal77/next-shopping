<?php

Route::group(['prefix' => 'product'], function () {

    $controller = 'ProductController';

    Route::get('/all', $controller . '@getAll');

    Route::get('/get', $controller . '@getProduct');

    Route::get('/get/by/newest', $controller . '@getNewestProducts');

    Route::get('/get/by/category', $controller . '@getProductByCategory');

    Route::get('/get/by/brand', $controller . '@getProductByBrand');

    Route::get('/get/by/price-range', $controller. '@getProductByPriceRange');

    Route::get('/get/by/search', $controller . '@getProductBySearchKey');

    Route::get('/get/by/most-liked', $controller . '@getMostLikedProducts');

    Route::get('/get/by/flash-sales', $controller . '@getFlashSales');

    Route::get('/get/by/top-sales', $controller . '@getTopSales');

    Route::get('/get/by/special', $controller . '@getSpecialProducts');

    Route::get('/get/by/just-for-you', $controller . '@getJustForYouProducts');

    Route::get('{id}',$controller . '@getProductDetail');

    Route::get('filter/{limit}/{offset}', $controller . '@filterProducts');

    Route::get('filter/info', $controller . '@filterInfo');

    Route::get('filter/more/{type}', $controller . '@filterMore');
});
