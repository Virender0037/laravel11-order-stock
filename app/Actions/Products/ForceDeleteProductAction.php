<?php

namespace App\Actions\Products;
use App\Models\Product;

use Lorisleiva\Actions\Concerns\AsAction;

class ForceDeleteProductAction
{
    use AsAction;

    public function execute(Product $product)
    {
        if( !$product->trashed()){
            return false;
        }

        $product->forceDelete();
        return true;
    }
}
