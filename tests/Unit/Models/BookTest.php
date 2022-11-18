<?php

namespace Tests\Unit\Models;

use App\Models\Book;
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
        $invalid_book_information = [
            "description" => "101",
            "file_path" => null
        ];

        $book = $this->post(route("book.store", $invalid_book_information));

        $book->assertInvalid();
    }

    /**
     * Check the ability to create a new book
     *
     * @return void
     */
    public function test_create_new_book_record()
    {
        $book_information = [
            "title" => "Rich Dad Poor Dad",
            "description" => "Best Financial Education Book by Robert Kyosaki",
            "file_path" => "/pdfs/17847634-rich_dad_poor_dad.pdf"
        ];

        $this->post(route("book.store"), $book_information);

        $this->assertDatabaseHas("books", $book_information);
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

        $returned_book = $this->get(route("book.show", $created_book["id"]));

        // TODO: improve tests
        $this->assertSame($returned_book["title"], $created_book["title"]);
    }

    /**
     * Get information about all the stored books
     *
     * @return void
     */
    public function test_show_all_books()
    {
        // Create [faked] books
        Book::factory()->count(3)->create();

        $books = $this->get(route("book.index"));

        $books->assertJsonCount(3);

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

        $this->patch(route("book.update", $old_book_information["id"]), $new_book_information->toArray());

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

        $this->delete(route("book.destroy", $book["id"]));

        $this->assertDatabaseMissing("books", $book->toArray());
    }

    // TODO: add tests for the [edit & create] methods
}
