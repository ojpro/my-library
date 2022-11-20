<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

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
     * @param StoreBookRequest
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // validate the request
        $request->validated();

        // generate a name for the uploaded file
        $file_name = time() . "_" . $request->file("file")->getClientOriginalName();

        // TODO: improve by using event and jobs + write single trait for handling uploading files
        // store the file on the storage
        $file_path = Storage::putFileAs("upload/books", $request->file("file"), $file_name);

        // save book info on the database
        Book::create([
            "title" => $request->title,
            "description" => $request->description,
            "file_path" => $file_path
        ]);

        // return success response
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
        // find the book
        $book = Book::findOrFail($book["id"])->first();

        // return it
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // validate the request
        $request->validated();

        // check if the book exist
        $book = Book::findOrFail($book["id"])->first();

        // TODO: update only updated values
        // check if there is a file to upload
        if ($request->file()) {
            // generate a name for the uploaded file
            $file_name = time() . "_" . $request->file("file")->getClientOriginalName();

            // store the file on the storage
            $file_path = Storage::putFileAs("upload/books", $request->file("file"), $file_name);
        }

        // update book info on the database
        $book->update([
            "title" => $request->title,
            "description" => $request->description,
            "file_path" => $file_path ?? $book->file_path
        ]);

        return response()->json(["status" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // find the book
        $book = Book::findOrFail($book["id"])->first();

        // remove it
        $book->delete();

        // TODO: return better responses with [response code]
        // return success response
        return response()->json(["status" => "success"]);
    }
}
