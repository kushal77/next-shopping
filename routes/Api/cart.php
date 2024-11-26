<?php

Route::group(['prefix' => 'cart'], function () {

    $controller = 'CartApiController';

    Route::get('/getItems', $controller . '@getCartItems');

    Route::post('/addToCart', $controller . '@addToCart');

    Route::post('/removeItemFromCart', $controller . '@removeItemFromCart');

    Route::post('/updateItemInCart', $controller . '@updateItemInCart');

    Route::post('/addCouponToCart', $controller . '@addCouponToCart');

    Route::post('/saveOrder', $controller . '@saveOrder');
    
});
