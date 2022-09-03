<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinetController;


Route::post('/register' , [AuthController::class , 'register']);
Route::post('/login' , [AuthController::class , 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user' , [AuthController::class , 'user']);
    Route::post('/logout' , [AuthController::class , 'logout']);
    Route::get('/clinet/list' , [ClinetController::class , 'list']);
    Route::post('/clinet/add' , [ClinetController::class , 'add']);
    Route::get('/clinet/delete/{id}' , [ClinetController::class , 'delete']);
    Route::get('/clinet/single/{id}' , [ClinetController::class , 'single']);
    Route::post('/clinet/edit' , [ClinetController::class , 'edit']);
});

