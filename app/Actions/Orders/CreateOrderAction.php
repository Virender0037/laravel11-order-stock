<?php

namespace App\Actions\Orders;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction
{
    use AsAction;

    public function execute(array $data): Order
    {

        $data['created_by'] = Auth::id();

        return Order::create($data);
        
    }
}

