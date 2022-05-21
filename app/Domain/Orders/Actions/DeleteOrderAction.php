<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class DeleteOrderAction
{
    public function execute(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();
        return $order;
    }
}