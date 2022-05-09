<?php 

namespace App\Http\ApiV1\Modules\Orders\Controllers;

use App\Domain\Orders\Actions\CreateOrderAction;
use App\Domain\Orders\Actions\DeleteOrderAction;
use App\Domain\Orders\Actions\GetAllOrderAction;
use App\Domain\Orders\Actions\GetOrderAction;
use App\Domain\Orders\Actions\PatchOrderAction;
use App\Domain\Orders\Actions\ReplaceOrderAction;
use App\Http\ApiV1\Modules\Orders\Requests\CreateOrderRequest;
use App\Http\ApiV1\Modules\Orders\Requests\PatchOrderRequest;
use App\Http\ApiV1\Modules\Orders\Requests\ReplaceOrderRequest;
use App\Http\ApiV1\Modules\Orders\Resources\OrderResource;

class OrderController
{
    public function getList(GetAllOrderAction $action)
    {
        $orders = $action->execute();
        return response()->json($orders);
    }

    public function get(GetOrderAction $action, int $orderId)
    {
        return new OrderResource($action->execute($orderId));
    }

    public function post(CreateOrderAction $action, CreateOrderRequest $request)
    {
        return new OrderResource($action->execute($request->validated()));
    }

    public function delete(DeleteOrderAction $action, int $orderId)
    {
        return new OrderResource($action->execute($orderId));
    }

    public function patch(PatchOrderAction $action, PatchOrderRequest $request, int $orderId)
    {
        return new OrderResource($action->execute($orderId, $request->validated()));
    }

    public function put(ReplaceOrderAction $action, ReplaceOrderRequest $request, int $orderId)
    {
        return new OrderResource($action->execute($orderId, $request->validated()));
    }
}