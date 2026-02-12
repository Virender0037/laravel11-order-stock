<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Models\Customer;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index(Request $request)
        {
            $customers = Customer::query()
                ->when($request->search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                    });
                })
                ->paginate(2)
                ->withQueryString();
            return view('customers.index', compact('customers'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {   
        $validatedData = $request->validated();
        $customer = Customer::create($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {   
        $customer = Customer::findOrFail($id);
        $validatedData = $request->validated();
        $customer->update($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(string $id)
    {   
        $customer = Customer::findOrFail($id);
        $customer->delete(); 
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
