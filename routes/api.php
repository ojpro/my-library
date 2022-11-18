<?php

use App\Http\Controllers\APIs\BooksController;
use Illuminate\Support\Facades\Route;


Route::controller(BooksController::class)->prefix("books")->name("api.books.")->group(function () {

    Route::get("/", "index")->name("index");

    Route::get("/?search={query}&category={type}", function ($query, $category) {
        return $query . "  ====  " . $category;
    })->name("search");

    Route::post("/", "store")->name("store");

    Route::get("/{book}", "show")->name("show");

    Route::patch("/{book}", "update")->name("update");

    Route::delete("/", "destroy")->name("destroy");
});
