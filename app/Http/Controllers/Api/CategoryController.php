<?php

namespace App\Http\Controllers\Api;

use App\Filters\CategoryFilter;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //All categories
        $categories = Category::paginate();
        if($request->query()){
            $categoryFilter = new CategoryFilter();
            $queryItems = $categoryFilter->generateEloquentQuery($request);
            if(array_key_exists('error',$queryItems)){
                return response()->json(['error'=> true, 'message'=> $queryItems['error'],'data' => []],400);
            }
            $categories = Category::where($queryItems);
            //add products by category
            if(array_key_exists('includeproducts',$request->query())) $categories = $categories->with('products');
            $categories = $categories->paginate()->appends($request->query());
        }
        return new CategoryCollection($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
