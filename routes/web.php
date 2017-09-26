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
Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', 'GameController@start')->name('home');

    Route::post('/calculate', 'GameController@calculate')->name('calculate');

    Route::post('/save', 'ScoreController@save')->name('score-save');
    Route::get('/score', 'ScoreController@show')->name('score');

});
