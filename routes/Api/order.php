<?php

Route::group(['prefix' => 'order'], function () {

    $controller = 'OrderApiController';

    Route::get('/my', $controller . '@myOrder');

});
