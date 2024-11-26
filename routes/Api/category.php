<?php

Route::group(['prefix' => 'category'], function () {

    $controller = 'CategoryController';

    Route::get('/all', $controller . '@getAll');

    Route::get('/children/get', $controller . '@getChildren');

    Route::get('/get', $controller . '@getCategory');

});
