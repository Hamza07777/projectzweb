<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes(['register' => false, 'reset' => false]);


Route::group(['middleware' => ['auth','checkUserType']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('user-destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('userDestroy');
    Route::match(['get', 'post'], 'account', [App\Http\Controllers\SubAdminController::class, 'userUpdate'])->name('userUpdate');
    Route::match(['get', 'post'], 'change-password', [App\Http\Controllers\SubAdminController::class, 'changePassword'])->name('changePassword');
});

Route::group(['middleware' =>  ['admin','checkUserType']], function () {
    Route::resource('sub-admin', App\Http\Controllers\SubAdminController::class);
    Route::resource('vaccine-center', App\Http\Controllers\VaccineCenterController::class);
    Route::resource('vaccine-detail', App\Http\Controllers\VaccineDetailController::class);
    Route::resource('alert', App\Http\Controllers\AlertController::class);
    Route::get('sub-admin-destroy/{id}', [App\Http\Controllers\SubAdminController::class, 'destroy'])->name('subAdminDestroy');
    Route::get('vaccine-center-destroy/{id}', [App\Http\Controllers\VaccineCenterController::class, 'destroy'])->name('vaccineCenterDestroy');
    Route::get('vaccine-detail-destroy/{id}', [App\Http\Controllers\VaccineDetailController::class, 'destroy'])->name('vaccineDetailDestroy');
    Route::get('alert-destroy/{id}', [App\Http\Controllers\AlertController::class, 'destroy'])->name('alertDestroy');
});

