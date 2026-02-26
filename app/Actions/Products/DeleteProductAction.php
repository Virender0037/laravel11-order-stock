<?php

namespace App\Actions\Products;
use App\Models\Product;

use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProductAction
{
    use AsAction;

    public function execute(Product $product): void
    {
        $product->delete();
    }
}
