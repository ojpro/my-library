<?php

use App\Http\Controllers\APIs\BooksController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource("/books", BooksController::class);
Route::apiResource("/category", CategoryController::class);