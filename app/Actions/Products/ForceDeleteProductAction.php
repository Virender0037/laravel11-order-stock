<?php

namespace App\Actions\Products;
use App\Models\Product;

use Lorisleiva\Actions\Concerns\AsAction;

class ForceDeleteProductAction
{
    use AsAction;

    public function handle(Product $product)
    {
        if( !$product->trashed()){
            return false;
        }

        $product->forceDelete();
        return true;
    }
}
