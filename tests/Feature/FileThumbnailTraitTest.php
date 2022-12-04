<?php

namespace Tests\Feature;

use App\Traits\FileThumbnailTrait;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileThumbnailTraitTest extends TestCase
{
    /**
     * Test Generation of PDF Books' Thumbnail
     *
     * @return void
     */
    public function test_generate_pdf_thumbnail()
    {
        // TODO: ****** simplify this ****
        // file name
        $pdf_name = "code-in-python-3-ar-v1.0.0.pdf";

        // get the path of the testing pdf book
        $testing_pdf_path = Storage::path("/Resources/$pdf_name");

        // get the book name
        $testing_book_pdf_name = explode("/", $testing_pdf_path);
        $testing_book_name = explode(".pdf", end($testing_book_pdf_name))[0];

        // declare the thumbnail file path
        $thumbnail_path = "thumbnails/$testing_book_name.jpeg";

        // generate the pdf thumbnail
        FileThumbnailTrait::getPDFThumbnail($testing_pdf_path, $thumbnail_path);

        // thumbnail relative path
        $thumbnail_relative_path = dirname($testing_pdf_path) . "/" . $thumbnail_path;

        // assert that the thumbnail has been generated the given path
        $this->assertFileExists($thumbnail_relative_path);

    }
}
