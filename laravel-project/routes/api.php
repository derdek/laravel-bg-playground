<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/version', function () {
    Log::info('Version request');
    return response()->json(['version' => config('app.version')]);
});

Route::get('/tasks', [TaskController::class, 'getTasks']);
Route::post('/tasks', [TaskController::class, 'createTask']);
Route::get('/tasks/{task}', [TaskController::class, 'getTask']);
Route::put('/tasks/{task}', [TaskController::class, 'updateTask']);
Route::delete('/tasks/{task}', [TaskController::class, 'deleteTask']);
