<?php

namespace Tests\Unit\Models;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * Check the request validation
     *
     * @return void
     */
    public function test_validate_creation()
    {
        // define fake book information
        $wrong_book_information = [
            "title" => 9,
            "description" => "won\'t work",
            "file" => UploadedFile::fake()
                ->create(
                    "not-a-pdf-file.docx",
                    51 * 1024,
                    "application/pdf")
        ];

        // send the request to create new book
        $response = $this->post(route('api.books.store'), $wrong_book_information);

        $response->assertInvalid();

    }

    /**
     * Check the ability to create a new book
     *
     * @return void
     */
    public function test_create_new_book_record()
    {
        // fake all upload files to local disk
        Storage::fake("local");

        // create a fake file
        $file = UploadedFile::fake()->create(
            "rich-dad-pour-dad.pdf",
            8 * 1024,
            'application/pdf'
        );

        // create a fake book
        $book_information = Book::factory()->make([
            "file" => $file
        ]);

        // send the request
        $this->post(route("api.books.store"), $book_information->toArray());

        // declare file_path
        $file_path = "upload/books/" . time() . "_" . $file->getClientOriginalName();

        // verify if the file is uploaded
        Storage::disk('local')->assertExists($file_path);

        // assert that the database has that uploaded book
        $this->assertDatabaseHas("books", [
            "title" => $book_information["title"],
            "description" => $book_information["description"],
            "file_path" => $file_path
        ]);
    }

    /**
     * Show book information based on it [id]
     *
     * @return void
     */
    public function test_get_book_information()
    {
        // Create a [fake] book
        $created_book = Book::factory()->create();
        
        // request book information
        $returned_book = $this->get(route("api.books.show", $created_book));

        // Simplify variables for usability
        $created_book = $created_book->toArray();
        $returned_book = $returned_book->getOriginalContent()->toArray();

        // assert that the both books are equal
        $this->assertEquals($returned_book, $created_book);
    }

    /**
     * Get information about all the stored books
     *
     * @return void
     */
    public function test_show_all_books()
    {
        // Create [faked] books
        $created_books = Book::factory()->count(3)->create();

        // fetch all books from the database
        $returned_books = $this->get(route("api.books.index"));

        // Simplify variables for usability
        $created_books = $created_books->toArray();
        $returned_books = $returned_books->getOriginalContent()->toArray();

        // check if they are equals
        $this->assertEquals($returned_books, $created_books);
    }

    /**
     * Update book information
     *
     * @return void
     */
    public function test_update_book_information()
    {

        $old_book_information = Book::factory()->create();

        $new_book_information = Book::factory()->make();

        $this->patch(route("api.books.update", $old_book_information), $new_book_information->toArray());

        $this->assertDatabaseCount("books", 1)
            ->assertDatabaseHas("books", $new_book_information->toArray());
    }

    /**
     * Test to remove books from the library
     *
     * @return void
     */
    public function test_delete_a_book()
    {
        $book = Book::factory()->create();

        $this->delete(route("api.books.destroy", $book));

        $this->assertDatabaseMissing("books", $book->toArray())
            ->assertDatabaseCount("books", 0);
    }

    // TODO: add tests for the [edit & create] methods
}
