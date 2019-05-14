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

// ADMINISTRACIÓN ///////////////////////////////////////////////////////////////
Route::get('admin/cut','AdminController@cut')->name('admin.cut');
Route::get('admin/barcodes','AdminController@barcodes')->name('admin.barcodes');
Route::resource('admin','AdminController');

// REGISTROS
Route::get('user/perfil','UserController@perfil')->name('user.perfil');
Route::get('user/pass/{id}','UserController@showPass')->name('user.changepass');
Route::patch('user/updatepass/{id}','UserController@updatePass')->name('user.updatePass');
Route::get('user/role/{id}','UserController@showRole')->name('user.role');
Route::patch('user/updateRole/{id}','UserController@updateRole')->name('user.updateRole');
Route::resource('user','UserController');

Route::put('book/updateStock','BookController@updateStock')->name('book.updateStock');
Route::get('book/search','BookController@search')->name('book.search');
Route::resource('book','BookController');
Route::get('feature/newFeature/{id}','FeatureController@newFeature')->name('feature.newFeature');
Route::resource('feature','FeatureController');

Route::resource('classification','ClassificationController');
Route::resource('client','ClientController');
Route::resource('plant','PlantController');

// OPERACIONES //////////////////////////////////////////////////////////////////
Route::get('swap/search/book/{isbn}','SwapController@searchbook');
Route::resource('swap','SwapController');

Route::get('donation/donate','DonationController@donate')->name('donation.donate');
Route::get('donation/receive','DonationController@receive')->name('donation.receive');
Route::resource('donation','DonationController');
Route::resource('donor','DonorController');

Route::get('borrow/search/book/{isbn}','BorrowController@searchbook');
Route::get('devolution/search/book/{isbn}','BorrowController@searchborrowedbook')->name('devolution.search.book');
Route::resource('borrow','BorrowController');

// VENTAS ///////////////////////////////////////////////////////////////////////
Route::get('sale/search/book/{isbn}','SaleController@searchbook')->name('searchbook');
Route::get('sale/search/plant/{id}','SaleController@searchplant')->name('searchplant');
Route::resource('sale','SaleController');
/////////////////////////////////////////////////////////////////////////////////
