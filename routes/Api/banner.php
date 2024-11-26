<?php

Route::group(['prefix' => 'banner'], function () {

    $controller = 'BannerController';

    Route::get('/all', $controller . '@getAll');

});
