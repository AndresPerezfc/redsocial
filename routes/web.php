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

Route::view('/', 'welcome')->name('home');

//rutas de los estados
Route::get('statuses', 'StatusesController@index');
Route::post('statuses', 'StatusesController@store')->name('statuses.store')->middleware('auth');

//rutas de los likes de los estados
Route::post('statuses/{status}/likes', 'StatusLikeController@store')->name('statuses.likes.store')->middleware('auth');

Route::auth();