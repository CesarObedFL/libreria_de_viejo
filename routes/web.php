<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes...
Route::get('login', [ LoginController::class, 'showLoginForm' ] )->name('login');
Route::post('login', [ LoginController::class, 'login' ] );
Route::post('logout', [ LoginController::class, 'logout' ] )->name('logout');

// Registration Routes...
Route::get('register', [ RegisterController::class, 'showRegistrationForm' ] )->name('register');
Route::post('register', [ RegisterController::class, 'register' ] );

// Password Reset Routes...
Route::get('password/reset', [ ForgotPasswordController::class, 'showLinkRequestForm' ] );
Route::post('password/email', [ ForgotPasswordController::class, 'sendResetLinkEmail' ] );
Route::get('password/reset/{token}', [ ResetPasswordController::class, 'showResetForm' ] );
Route::post('password/reset', [ ResetPasswordController::class, 'reset' ] );

Route::get('/home', [ HomeController::class, 'index' ] )->name('home');

// ADMINISTRACIÓN ///////////////////////////////////////////////////////////////
Route::get('admin/cut',[ AdminController::class, 'cut' ] )->name('admin.cut');
Route::get('admin/barcodes', [ AdminController::class, 'barcodes' ] )->name('admin.barcodes');
Route::post('admin/pdf', [ AdminController::class, 'pdf' ] )->name('admin.pdf');
Route::get('admin/search/book/{title}', [ AdminController::class, 'searchbook' ] );
Route::resource('admin', AdminController::class )->only([ 'edit', 'update' ]);

// REGISTROS
Route::get('user/pass/{id}', [ UserController::class, 'showPass' ] )->name('user.changepass');
Route::patch('user/updatepass/{id}', [ UserController::class, 'updatePass' ] )->name('user.updatePass');
Route::get('user/role/{id}', [ UserController::class, 'showRole' ] )->name('user.role');
Route::patch('user/updateRole/{id}', [ UserController::class, 'updateRole' ] )->name('user.updateRole');
Route::resource('users', UserController::class );

Route::put('book/updateStock', [ BookController::class, 'updateStock' ] )->name('book.updateStock');
Route::get('book/search', [ BookController::class, 'search' ] )->name('book.search');
Route::resource('books',BookController::class);
Route::get('feature/newFeature/{id}', [ FeatureController::class, 'newFeature' ] )->name('feature.newFeature');
Route::resource('features', FeatureController::class )->except([ 'index', 'create' ]);

Route::resource('classifications', ClassificationController::class )->except([ 'show' ]);
Route::resource('clients', ClientController::class );
Route::resource('plants', PlantController::class );

// OPERACIONES //////////////////////////////////////////////////////////////////
Route::get('swap/search/book/{isbn}', [ SwapController::class, 'searchbook' ] );
Route::resource('swaps', SwapController::class );

Route::get('donation/donate', [ DonationController::class, 'donate' ] )->name('donation.donate');
Route::get('donation/receive', [ DonationController::class, 'receive' ] )->name('donation.receive');
Route::resource('donations', DonationController::class )->except([ 'create', 'edit', 'update' ]);
Route::resource('donors', DonorController::class )->except([ 'show' ]);

Route::get('borrow/search/book/{isbn}', [ BorrowController::class, 'searchbook' ] );
Route::get('devolution/search/book/{isbn}', [ BorrowController::class, 'searchborrowedbook' ] )->name('devolution.search.book');
Route::resource('borrows', BorrowController::class )->except([ 'destroy' ]);

// VENTAS ///////////////////////////////////////////////////////////////////////
Route::get('sale/search/book/{isbn}', [ SaleController::class, 'searchbook' ] )->name('searchbook');
Route::get('sale/search/plant/{id}', [ SaleController::class, 'searchplant' ] )->name('searchplant');
Route::resource('sales', SaleController::class )->except([ 'edit', 'update', 'destroy' ]);
/////////////////////////////////////////////////////////////////////////////////
