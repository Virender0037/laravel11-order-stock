<?php

namespace App\Actions\Products;
use App\Models\Product;

use Lorisleiva\Actions\Concerns\AsAction;

class RestoreProductAction
{
    use AsAction;

    public function execute(Product $product)
    {
        if( !$product->trashed()){
            return false;
        }

        $product->restore();
        return true;
    
    }
}
