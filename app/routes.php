<?php

Route::post('api/login', 'HomeController@login');
Route::get('index', 'SafeTronicsController@index');
Route::get('kategorije', 'SafeTronicsController@kategorije');
Route::get('sefovi', 'SafeTronicsController@all');
Route::get('sef/{id}', 'SafeTronicsController@show');
Route::get('kategorija/{id}', 'SafeTronicsController@kategorija');

Route::group(array('prefix' => 'api', 'before' => 'auth.token'), function() {
    Route::get('logout', 'HomeController@logout');
    Route::resource('kategorije', 'KategorijeSefovaController');
    Route::resource('sefovi', 'SefoviController');
});

