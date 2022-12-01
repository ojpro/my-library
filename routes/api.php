<?php

use App\Http\Controllers\APIs\BooksController;
use Illuminate\Support\Facades\Route;

Route::apiResource("/books", BooksController::class);