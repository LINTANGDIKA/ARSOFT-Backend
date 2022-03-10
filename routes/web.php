<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
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

Route::get('/login', [loginController::class, 'viewLogin'])->name('login');
Route::post('/login', [loginController::class, 'loginSistem']);
Route::get('/logout', [loginController::class, 'logout']);
Route::get('/', [HomeController::class, 'home'])->name('home');