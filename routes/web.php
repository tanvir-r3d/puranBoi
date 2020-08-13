<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user', 'UserController');

Route::resource('client', 'ClientController');
Route::resource('institute','InstituteController');
Route::get('client/doc/{id}','DocDownloader');
Route::post('client/doc/{id}/delete','DocDeleteController');
