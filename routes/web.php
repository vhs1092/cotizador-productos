<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/cotizador', 'CotizadorController@index')->name('home');
Route::get('/productos', 'HomeController@index')->name('home');
Route::get('/materiales', 'HomeController@index')->name('home');
Route::get('/admin/materiales/create', 'HomeController@index')->name('home');
Route::get('/admin/products/create', 'HomeController@index')->name('home');
