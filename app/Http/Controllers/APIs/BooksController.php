<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * Display the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book["id"])->first();

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

        $book = Book::findOrFail($id);

        $book->delete();

        //TODO: return better responses with [response code]

        return response()->json(["status" => "success"]);
    }
}
