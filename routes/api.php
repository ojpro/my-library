<?php

use App\Http\Controllers\APIs\BooksController;
use Illuminate\Support\Facades\Route;


Route::controller(BooksController::class)->prefix("books")->name("api.books.")->group(function () {

    Route::get("/", "index")->name("index");

    Route::post("/", "store")->name("store");

    Route::get("/{book}", "show")->name("show");

    Route::patch("/{book}", "update")->name("update");

    Route::delete("/{book}", "destroy")->name("destroy");
});
