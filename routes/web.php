<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


Route::resource("/book", \App\Http\Controllers\BookController::class);
