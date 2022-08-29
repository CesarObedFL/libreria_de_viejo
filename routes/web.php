<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// ADMINISTRACIÓN ///////////////////////////////////////////////////////////////
Route::get('admin/cut','AdminController@cut')->name('admin.cut');
Route::get('admin/barcodes','AdminController@barcodes')->name('admin.barcodes');
Route::post('admin/pdf','AdminController@pdf')->name('admin.pdf');
Route::get('admin/search/book/{title}','AdminController@searchbook');
Route::resource('admin','AdminController');

// REGISTROS
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
