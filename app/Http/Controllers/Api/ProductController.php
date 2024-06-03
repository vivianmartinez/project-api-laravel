<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //All products
        $products = Product::paginate();
        if($request->query()){
            $productFilter = new ProductFilter();
            $queryItems = $productFilter->generateEloquentQuery($request);
            if(array_key_exists('error',$queryItems)){
                return response()->json(['error'=> true, 'message'=> $queryItems['error'],'data' => []],400);
            }
            $products = Product::where($queryItems);
            //products with category
            if(array_key_exists('includecategory',$request->query())) $products = $products->with('category');
            $products = $products->paginate()->appends($request->query());
        }
        return new ProductCollection($products);
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
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
