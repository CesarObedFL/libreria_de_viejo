<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');

// REGISTROS
Route::resource('user', 'UserController')->middleware('auth');
Route::resource('book', 'BookController')->middleware('auth');
Route::resource('classification', 'ClassificationController')->middleware('auth');
Route::resource('client', 'ClientController')->middleware('auth');
Route::resource('plant', 'PlantController')->middleware('auth');

// OPERACIONES
Route::resource('sale', 'SaleController');
Route::resource('bartering', 'BarteringController');
