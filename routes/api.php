<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [ApiController::class, 'userRegistrasi']);
Route::post('/login', [ApiController::class, 'userLogin']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/todo', [TodoController::class, 'createTodo']);
    Route::post('/todo/{id}', [TodoController::class, 'updateTodo']);
    Route::get('/todo/{id}', [TodoController::class, 'findDataId']);
    Route::get('/todo', [TodoController::class, 'findData']);
    Route::get('/user/todo', [TodoController::class, 'findTodobyUser']);
    Route::get('/todo/done/{id}', [TodoController::class, 'done']);
    Route::get('/todo/onchange/{id}', [TodoController::class, 'onchange']);
    Route::get('/todo/delete/{id}', [TodoController::class, 'delete']);
    Route::get('/logout', [ApiController::class, 'logout']);
});
