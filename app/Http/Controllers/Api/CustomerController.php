<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Filters\CustomerFilter;
use App\Http\Resources\CustomerCollection;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //all customers
        $customers = Customer::paginate();
        // if params query
        if($request->query()){
            $customerFilter = new CustomerFilter();
            $queryItems = $customerFilter->generateEloquentQuery($request);
            if(array_key_exists('error',$queryItems)){
                return response()->json(['error'=> true, 'message'=> $queryItems['error'],'data' => []],400);
            }
            $customers = Customer::where($queryItems);
             //add orders by customer
            if(array_key_exists('includeorders',$request->query())) $customers = $customers->with('orders');

            $customers = $customers->paginate()->appends($request->query());
        }
        return new CustomerCollection($customers);
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
    public function store(StoreCustomerRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
