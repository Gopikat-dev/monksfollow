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
Route::get('/', [UserController::class, "home"]);
Route::post('/register', [UserController::class, "register"]);
Route::get('/register', [UserController::class, "registerReturn"]);
Route::post('/verifyotp', [UserController::class, "verifyOtp"]);
Route::get('/verifyotp', [UserController::class, "verifyOtpReturn"]);

//dashboard controllers

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/logout', [DashboardController::class, 'logout']);
