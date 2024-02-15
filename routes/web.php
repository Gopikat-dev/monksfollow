<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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


//user controllers
Route::get('/', [UserController::class, "home"])->middleware('prevent.authenticated');
Route::post('/register', [UserController::class, "register"])->middleware('prevent.authenticated');
Route::get('/register', [UserController::class, "registerReturn"])->middleware('prevent.authenticated');
Route::post('/verifyotp', [UserController::class, "verifyOtp"])->middleware('guest');
Route::get('/verifyotp', [UserController::class, "verifyOtpReturn"]);

//dashboard controllers

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/logout', [DashboardController::class, 'logout']);
