<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Actions\Products\CreateProductAction;   
use App\Actions\Products\UpdateProductAction;
use App\Actions\Products\DeleteProductAction;
use App\Actions\Products\ForceDeleteProductAction;
use App\Actions\Products\RestoreProductAction;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
     $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request)
    {   
       $query = Product::with('user');
       if((int) Auth()->user()->is_admin !== 1){
        $query->where('created_by', Auth::id());
       }
       $search = $request->input('search');
        if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
        }
        $products = $query->paginate(15)->appends(['search' => $search]);
        return view('products.index', compact('products'));
    }

    public function indextrash(Request $request)
    {  
       $this->authorize('viewTrashed', Product::class);
       $query = Product::onlyTrashed()->with('user');
        if((int) Auth()->user()->is_admin !== 1){
            $query->where('created_by', Auth::id());
        }
        $Products = $query->paginate(15);
        return view('products.trash', compact('Products'));
    }

    public function restore(Product $product, RestoreProductAction $action){
        $this->authorize('restore', $product);
        if ($action->execute($product)) { 
            return redirect()->route('products.index')->with('success', 'Product restored successfully.');
        }
            return redirect()
            ->route('products.trash')
            ->with('info', 'Product is not deleted.');
    }

    public function forceDelete(Product $product, ForceDeleteProductAction $action){
      $this->authorize('forceDelete', $product);
      if($action->execute($product)){
        return redirect()
        ->route('products.trash')
        ->with('success', 'Product permanently deleted.');
        }
        return redirect()
        ->route('products.trash')
        ->with('success', 'Product is not deleted.');
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request, CreateProductAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('products.index')->with('success', 'Customer product successfully.');
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
    public function edit(Product $product)
    {   
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $action)
    {
        $action->execute($product, $request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, DeleteProductAction $action)
    {
        $action->execute($product); 
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
