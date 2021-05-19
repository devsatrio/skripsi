<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'backend\HomeController@index')->name('home');
Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

Route::get('/data-admin','backend\AdminController@listdata');
Route::resource('/admin','backend\AdminController');

Route::get('/data-produk','backend\ProdukController@listdata');
Route::resource('/produk','backend\ProdukController');

Route::get('/data-dataset','backend\DatasetController@listdata');
Route::resource('/dataset','backend\DatasetController');

Route::get('/prediksi-minat','backend\PrediksiController@index');
Route::post('/prediksi-minat','backend\PrediksiController@store');

Route::get('/testing-algoritma','backend\TestingController@index');
Route::post('/testing-algoritma/testing','backend\TestingController@store');