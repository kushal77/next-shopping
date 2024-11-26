<?php

Route::group(['prefix' => 'contact'], function () {

    $controller = 'ContactController';

    Route::post('/post', $controller . '@postContact');

});
