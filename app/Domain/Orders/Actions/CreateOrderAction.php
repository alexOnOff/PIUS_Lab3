<?php 

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class CreateOrderAction
{
    public function execute(array $fields): Order
    {
        return Order::create($fields);
    }
}