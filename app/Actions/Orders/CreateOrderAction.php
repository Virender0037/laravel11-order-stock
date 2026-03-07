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

        return Order::create([
            'customer_id' => $data['customer_id'],
            'created_by' => $data['created_by'],
            'order_no' => $data['order_no'] ?? 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'total_amount' => 0,
        ]);
    }
}

