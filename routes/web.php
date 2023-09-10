<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*The hmoe page is the login page*/

Route::get('/', function () {
    return view('auth.login');
});
/*Auth Package*/
Auth::routes();
//Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Invoices*/
Route::resource('invoices', InvoicesController::class);

/*Sections*/
Route::resource('sections', SectionsController::class);
/*Home Page*/
Route::get('/{page}', [AdminController::class, 'index']);