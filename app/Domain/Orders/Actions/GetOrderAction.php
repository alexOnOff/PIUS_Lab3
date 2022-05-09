<?php 

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class GetOrderAction
{
    public function execute(int $orderId): Order
    {
        return Order::findOrFail($orderId);
    }
}