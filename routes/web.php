<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscuelaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('escuelas', EscuelaController::class);