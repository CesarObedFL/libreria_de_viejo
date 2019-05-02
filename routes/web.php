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
Route::get('user/perfil','UserController@perfil')->name('user.perfil')->middleware('auth');
Route::get('user/role/{ID}','UserController@showRole')->name('user.role')->middleware('auth');
Route::patch('user/updateRole/{ID}','UserController@updateRole')->name('user.updateRole')->middleware('auth');
Route::resource('user','UserController')->middleware('auth');

Route::put('book/updateStock','BookController@updateStock')->name('book.updateStock')->middleware('auth');
Route::get('book/search','BookController@search')->name('book.search')->middleware('auth');
Route::resource('book','BookController')->middleware('auth');
Route::get('feature/newFeature/{ID}','FeatureController@newFeature')->name('feature.newFeature')->middleware('auth');
Route::resource('feature','FeatureController')->middleware('auth');

Route::resource('classification','ClassificationController')->middleware('auth');
Route::resource('client','ClientController')->middleware('auth');
Route::resource('plant','PlantController')->middleware('auth');

// OPERACIONES
Route::resource('bartering','BarteringController');
Route::get('donation/donate','DonationController@donate')->name('donation.donate');
Route::get('donation/receive','DonationController@receive')->name('donation.receive');
Route::resource('donation','DonationController');
Route::resource('donor','DonorController');
Route::post('/loan/search','LoanController@search')->name('loan.search');
Route::get('loan/devolution','LoanController@devolution')->name('loan.devolution');
Route::resource('loan','LoanController');
//Route::resource('devolution')


// VENTAS ///////////////////////////////////////////////////////////////////////
Route::get('sale/books','SaleController@books')->name('BookSale');
Route::post('/searchBook','SaleController@searchBook')->name('SearchBook');
Route::get('sale/plants','SaleController@plants')->name('PlantSale');
Route::post('/searchPlant','SaleController@searchPlant')->name('SearchPlant');
Route::post('/sale/store','SaleController@store');
Route::resource('sale','SaleController');
/////////////////////////////////////////////////////////////////////////////////
