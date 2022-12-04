<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Traits\FileThumbnailTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // check if there is a search request
        if ($request->query('query')) {
            // TODO sort returned data
            // search that query in the [title, description]
            $books = Book::query()
                ->where('title', 'LIKE', "%" . request('query') . "%")
                ->orWhere('description', 'LIKE', "%" . request('query') . "%")
                ->get();
        } else { // other ways return all books
            $books = Book::all();
        }
        // return the result
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest
     * @return Response
     */
    public function store(StoreBookRequest $request)
    {
        // validate the request
        $request->validated();

        // generate a name for the uploaded file
        $file_name = time() . "_" . $request->file("file")->getClientOriginalName();

        // TODO: improve by using event and jobs + write single trait for handling uploading files
        // store the file on the storage
        $file_path = Storage::disk('public')->putFileAs("upload/books", $request->file("file"), $file_name);

        // TODO: DRY
        // declare book thumbnail location
        $filename_without_extension = explode('.pdf', $file_name)[0];
        $thumbnail_path = "thumbnails/$filename_without_extension.jpeg";

        // generate book thumbnail
        FileThumbnailTrait::getPDFThumbnail(Storage::disk('public')->path($file_path), $thumbnail_path);

        // save book info on the database
        Book::create([
            "title" => $request->title,
            "description" => $request->description,
            "file_path" => Storage::url($file_path),
            "book_thumbnail" => Storage::url("upload/books/" . $thumbnail_path)
        ]);

        // return success response
        return response()->json(["status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function show(Book $book)
    {
        // find the book
        $result = Book::find($book["id"]);

        // return it
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest
     * @param Book $book
     * @return Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // validate the request
        $request->validated();

        // check if the book exist
        $book = Book::findOrFail($book["id"]);

        // TODO: update only updated values
        // check if there is a file to upload
        if ($request->file()) {
            // generate a name for the uploaded file
            $file_name = time() . "_" . $request->file("file")->getClientOriginalName();

            // store the file on the storage
            $file_path = Storage::disk('public')->putFileAs("upload/books", $request->file("file"), $file_name);
            $file_path = Storage::url($file_path);


            // declare book thumbnail location
            $filename_without_extension = explode('.pdf', $file_name)[0];
            $thumbnail_path = "thumbnails/$filename_without_extension.jpeg";

            // generate book thumbnail
            FileThumbnailTrait::getPDFThumbnail(Storage::disk('public')->path($file_path), $thumbnail_path);
        }

        // TODO: delete old files
        // update book info on the database
        $book->update([
            "title" => $request->title,
            "description" => $request->description,
            "file_path" => $file_path ?? $book->file_path,
            "book_thumbnail" => Storage::url("upload/books/" . $thumbnail_path) ?? $book->book_thumbnail
        ]);

        return response()->json(["status" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        // find the book
        $book = Book::findOrFail($book["id"]);

        // Remove the book file
        if (Storage::disk('public')->delete($book["file_path"])) {

            // TODO: delete thumbnail file
            // remove record from database
            $book->delete();
        } else {
            return response()->json('Something wrong, please try again.', 404);
        }

        // TODO: return better responses with [response code]
        // return success response
        return response()->json(["status" => "success"]);
    }
}
