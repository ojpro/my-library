<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // TODO: need testing
        // check if there is a search request
        if ($request->query('query')) {
            // TODO sort returned data
            // search that query in the [name, description]
            $categories = Category::query()
                ->where('name', 'LIKE', "%" . request('query') . "%")
                ->orWhere('description', 'LIKE', "%" . request('query') . "%")
                ->get();
        } else { // other ways return all categories
            $categories = Category::all();
        }

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // validate the creation request
        $request->validated();

        // create the category
        $category = Category::create($request->all());

        // return success message
        return response()->json(['status' => 'success', 'category' => $category]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::findOrFail($category['id']);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();

        $old_category = Category::findOrFail($category['id']);

        $category = $old_category->update($request->all());

        //TODO: improve response messages
        return response()->json(['status' => 'success', 'category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category['id']);

        $category->delete();

        return response()->json(['status' => 'success']);
    }
}
