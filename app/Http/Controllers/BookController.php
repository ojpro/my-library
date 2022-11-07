<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::all();

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            "title" => ["required", "string", "min:5", "unique:books,title"],
            "description" => ["required", "string", "min:20"],
            "file_path" => ["required", "string"]
        ]);

        Book::create($request->all(['title', 'description', 'file_path']));

        return response()->json(["status" => "success"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book["id"])->first();

        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            "title" => ["required", "string", "min:5", "unique:books,title," . $book["id"]],
            "description" => ["required", "string", "min:20"],
            "file_path" => ["required", "string"]
        ]);

        $book = Book::findOrFail($book["id"])->first();

        $book->update($request->all());

        return response()->json(["status" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book = Book::findOrFail($book["id"]);

        $book->delete();

        //TODO: return better responses with [response code]

        return response()->json(["status" => "success"]);
    }
}
