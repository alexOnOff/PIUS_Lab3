<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class GetAllOrderAction
{
    public function execute(): array
    {
        return Order::all()->toArray();
    }
}