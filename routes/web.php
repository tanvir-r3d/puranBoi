<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user', 'UserController');

Route::resource('client', 'ClientController');
