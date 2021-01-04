<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Tasks\TaskController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/item','TaskController@index');
Route::get('/item',[TaskController::class,'index']);

Route::prefix('/item')->group( function() {
    // Route::post('/store','TaskController@store');
    Route::post('/store',[TaskController::class,'store']);

    Route::put('/{id}',[TaskController::class,'update']);
    Route::delete('/{id}',[TaskController::class,'destory']);
});