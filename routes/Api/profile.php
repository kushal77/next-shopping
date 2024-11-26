<?php

Route::group(['prefix' => 'profile'], function () {

    $controller = 'ProfileController';

    Route::get('/get', $controller . '@getUserDetail');

    Route::post('/post', $controller . '@postUserDetail');
    Route::post('/update', $controller . '@updateProfile');
    Route::post('/change_psw', $controller . '@updatePsw');
});
