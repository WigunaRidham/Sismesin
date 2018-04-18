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

Route::get('/', 'FrontController@index')->name('front');
Route::post('/', 'FrontController@findVehicle')->name('find');

Auth::routes();

//Route::get('/register', function () {
//    return abort(404);
//});

Route::get('/cetak/laporan/{id}', 'FrontController@cetakLaporan')->name('cetak');
Route::get('/cetak/history', 'FrontController@cetakHistory')->name('cetak_history');

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('check', 'ChecksController');