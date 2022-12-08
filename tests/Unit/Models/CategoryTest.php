<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Check if creating new category
     */

    public function test_create_new_category()
    {
        // dummy category information
        $category = Category::factory()->make();

        // send creation request
        $response = $this->post(route('category.store'), $category->toArray());

        // assert that the category created successfully
        $response->assertOk();

        $this->assertDatabaseCount('categories', 1)
            ->assertDatabaseHas('categories', $category->toArray());

    }

    /**
     * Check if the validation working
     */
    public function test_validation()
    {
        // dummy category information
        $category = Category::factory()->make([
            'name' => 2
        ]);

        // send creation request
        $response = $this->post(route('category.store'), $category->toArray());

        // assert that there is a creation problem
        $response->assertInvalid();
    }


    /**
     * Test fetching category information
     *
     */
    public function test_get_category_info()
    {
        // dummy category information
        $category = Category::factory()->create();

        // send fetch request
        $response_category = $this->get(route('category.show', $category));

        // simplify the variables
        $category = $category->toArray();
        $response_category = $response_category->getOriginalContent()->toArray();

        // check if are the same
        $this->assertEquals($response_category, $category);
    }

    public function test_get_all_categories_info()
    {
        // dummy categories
        $categories = Category::factory()->count(4)->create();

        // send get request for all categories
        $returned_categories = $this->get(route('category.index'));

        // convert to arrays
        $created_categories = $categories->toArray();
        $returned_categories = $returned_categories->getOriginalContent()->toArray();
        
        // test
        $this->assertEquals($created_categories, $returned_categories);
    }

    /**
     * Check update functionality
     */

    public function updating_a_category()
    {
        // dummy category information
        $category_1 = Category::factory()->create();
        $category_2 = Category::factory()->make();

        // send fetch request
        $this->get(route('category.update', $category_1), $category_2);

        // check if the category has been updated
        $this->assertDatabaseHas('categories', $category_2->toArray())
            ->assertDatabaseMissing('categories', $category_2);
    }

    /**
     * check deleting of a category
     */

    public function test_delete_category()
    {
        // dummy category information
        $category = Category::factory()->create();

        // send delete request
        $this->delete(route('category.destroy', $category));

        // check that the category has been deleted successfully
        $this->assertDatabaseCount('categories', 0)
            ->assertDatabaseMissing('categories', $category->toArray());
    }
}
