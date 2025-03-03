<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('tasks', TaskController::class);

Route::controller(TaskController::class)->group(function () {
    Route::group([
        'prefix' => 'tasks',
        'middleware' => 'auth:sanctum',
    ], function(){
        Route::get('/','index');
        Route::post('/','store');
        Route::post('/{id}','update');
        Route::delete('/{id}','destroy');
    });
});
Route::controller(UserController::class)->group(function () {
    Route::group([], function(){
        Route::post('/login','login');
        });
});
