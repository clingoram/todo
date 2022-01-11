<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\Category\CategoryController;
// use App\Http\Controllers\Task\TaskController;
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


Route::prefix('/items')->group(function () {
    // Category
    Route::get('/categories', [CategoryController::class, 'index']);
    // Route::get('/categories', 'App\Http\Controllers\Category\CategoryController@index');

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Task
    Route::get('', [TaskController::class, 'index']);
    // Route::get('', 'App\Http\Controllers\Task\TaskController@index');
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{id}', [TaskController::class, 'show']);
    // Route::match(['get', 'post'], '/{id}', [TaskController::class, 'show']);

    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy']);
});
