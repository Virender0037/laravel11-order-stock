<?php

namespace App\Actions\Products;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreateProductAction
{
    use AsAction;

    public function execute(array $data): Product
    {
        $data['created_by'] = Auth::id();

        return Product::create($data);
    }
}
