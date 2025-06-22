<?php

use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/tasks')->group(function (){
    Route::get('/getCompleted', [TaskController::class, 'getCompleted']);
    Route::get('/', [TaskController::class, 'getAll'])->middleware(['auth:sanctum', 'api']);
    Route::get('/{id}', [TaskController::class, 'getById']);
    Route::post('/create', [TaskController::class, 'create'])->middleware('auth:sanctum');
    Route::put('/update', [TaskController::class, 'update'])->middleware(['auth:sanctum', 'api']);
    Route::delete('/delete', [TaskController::class, 'delete'])->middleware(['auth:sanctum', 'api']);
});

Route::prefix('v1/users')->group(function (){
    Route::post('/register', [UserController::class, 'register'])->middleware('api');
    Route::post('/login', [UserController::class, 'login'])->middleware('api');
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/getUser', [UserController::class, 'getUser'])->middleware('auth:sanctum');
});
