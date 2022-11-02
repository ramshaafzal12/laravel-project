<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StallController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('users/all', [UserController::class, 'index']);
    Route::post('users/{id}/delete/', [UsersController::class, 'destroy'])->name('users.delete');
    Route::resource('users', UserController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::get('companies/all', [CompanyController::class, 'index']);
    Route::post('company/{id}/delete/', [CompanyController::class, 'destroy'])->name('companies.delete');
    Route::resource('company', CompanyController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::get('agencies/all', [AgencyController::class, 'index']);
    Route::post('agency/{id}/delete/', [AgencyController::class, 'destroy'])->name('agencies.delete');
    Route::resource('agency', AgencyController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('stalls/all', [StallController::class, 'index']);
    Route::post('stall/{id}/delete/', [StallController::class, 'destroy'])->name('stalls.delete');
    Route::resource('stall', StallController::class);
});