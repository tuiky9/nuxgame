<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('register');
});

Route::post('register', [UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/room/{uuid}', function ($uuid) {
        return view('room', ['uuid' => $uuid]);
    })->whereUuid('uuid');
    Route::post('links/create', [LinkController::class, 'create']);
    Route::post('links/delete', [LinkController::class, 'delete']);
});
