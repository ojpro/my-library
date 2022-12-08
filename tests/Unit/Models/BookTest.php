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
    public function test_validate_creation(): void
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
        $response = $this->post(route('books.store'), $wrong_book_information);

        $response->assertInvalid();

    }

    /**
     * Check the ability to create a new book
     *
     * @return void
     */
    public function test_create_new_book_record(): void
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
        $this->post(route("books.store"), $book_information->toArray());

        // declare file_path
        $file_path = "upload/books/" . time() . "_" . $file->getClientOriginalName();

        // verify if the file is uploaded
        $this->assertFileExists(Storage::disk('public')->path($file_path));

        // assert that the database has that uploaded book
        $this->assertDatabaseHas("books", [
            "title" => $book_information["title"],
            "description" => $book_information["description"],
            "file_path" => Storage::url($file_path)
        ]);
    }

    /**
     * Show book information based on it [id]
     *
     * @return void
     */
    public function test_get_book_information(): void
    {
        // Create a [fake] book
        $created_book = Book::factory()->create();

        // request book information
        $returned_book = $this->get(route("books.show", $created_book));

        // Simplify variables for usability
        $created_book = $created_book->toArray();
        $returned_book = $returned_book->getOriginalContent()->toArray();

        // TODO: improve testing method
        // assert that the both books are equal
        $this->assertSame([
            $returned_book['title'],
            $returned_book['description'],
            $returned_book['file_path']
        ], [
            $created_book['title'],
            $created_book['description'],
            $created_book['file_path']
        ]);
    }

    /**
     * Get information about all the stored books
     *
     * @return void
     */
    public function test_show_all_books(): void
    {
        // Create [faked] books
        Book::factory()->count(3)->create();

        // fetch all books from the database
        $returned_books = $this->get(route("books.index"));

        // Simplify variables for usability
        $returned_books = $returned_books->getOriginalContent()->toArray();

        // TODO: improve verification method
        // check if they are equals
        $this->assertCount(3, $returned_books);
    }

    /**
     * Update book information
     *
     * @return void
     */
    public function test_update_book_information(): void
    {
        // make a fake upload on the local disk
        Storage::fake('local');

        // generate a fake book
        $old_book_information = Book::factory()->create([
            "book_thumbnail" => 'temp-thumbnail.jpeg'
        ]);

        // create a fake file
        $file = UploadedFile::fake()->create(
            "rich-dad-pour-dad.pdf",
            8 * 1024,
            'application/pdf'
        );

        // generate a new faked book
        $new_book_information = Book::factory()->make();

        // send update request
        $this->patch(
            route("books.update", $old_book_information),
            $new_book_information->toArray());

        // TODO: check the update of the thumbnail in case uploaded

        // check if the book information updated
        $this->assertDatabaseHas("books", [
            "title" => $new_book_information["title"],
            "description" => $new_book_information["description"]
        ]);
    }

    /**
     * Test to remove books from the library
     *
     * @return void
     */
    public function test_delete_a_book(): void
    {
        $book = Book::factory()->create();

        $this->delete(route("books.destroy", $book));

        $this->assertDatabaseMissing("books", $book->toArray())
            ->assertDatabaseCount("books", 0);
    }

    /**
     * Test to validate search method
     */
    public function test_searching_for_books()
    {
        // Generate 3 books with only 2 having similar word
        Book::factory()->create([
            'title' => "How to success in your life"
        ]);
        Book::factory()->create([
            'title' => "Now when to leave"
        ]);
        Book::factory()->create([
            'title' => "10 successful business modules"
        ]);

        // send search request with query
        $response = $this->get(route('books.index', ['query' => 'success']));

        // TODO: improve this too
        // check if it's working
        $response->assertJsonCount(2);

    }

    // TODO: add tests for the [edit & create] methods
}
