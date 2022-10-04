<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1/todo'], function () {
    Route::get('/', [TodoController::class, 'getTodo']);
    Route::post('add', [TodoController::class, 'addTodo']);
    Route::post('change-status', [TodoController::class, 'changeStatus']);
});
