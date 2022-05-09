<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Orders\Models\Order;
use Illuminate\Contracts\Filesystem\Cloud;
use League\CommonMark\Node\Query\OrExpr;

class OrderTest extends TestCase
{
    public function test_get_all_order_returns_a_successful_response()
    {
        $response = $this->get('/api/v1/orders');

        $response->assertStatus(200);
    }

    public function test_get_client_by_id_returns_a_successful_response()
    {
        $order = Order::factory()->create();
        $response = $this->get('/api/v1/orders/' . $order->id);

        $data = [
            'data' => [
                'id' => $order->id,
                'client_id' => $order->client_id,
                'auto_id' => $order->auto_id,
                'type' => $order->type,
                'startPoint' => $order->startPoint,
                'finishPoint' => $order->finishPoint,
                'distance' => $order->distance,
                'time' => $order->time,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_get_order_by_id_returns_a_bad_request_response()
    {
        $response = $this->get('/api/v1/orders/skdsjgn');
        $response->assertStatus(400);
    }
    public function test_get_order_by_id_returns_a_not_found_response()
    {
        $order = Order::factory()->create();
        $response = $this->get('/api/v1/orders/' . $order->id + 1);
        $response->assertStatus(404);
    }
    public function test_create_order_returns_a_successful_response()
    {
        $order = Order::factory()->raw();
        $response = $this->postJson('/api/v1/orders/', $order);
        $data = [
            'data' => [
                'id' => $order['id'],
                'client_id' => $order['client_id'],
                'auto_id' => $order['auto_id'],
                'type' => $order['type'],
                'startPoint' => $order['startPoint'],
                'finishPoint' => $order['finishPoint'],
                'distance' => $order['distance'],
                'time' => $order['time'],
            ],
        ];
        $response->assertStatus(201)->assertJson($data);
        $this->assertDatabaseHas('orders', $order);
    }
    public function test_create_order_returns_a_bad_request_response()
    {
        $order = Order::factory()->raw();
        $this->postJson('/api/v1/orders/', $order);

        $response = $this->postJson('/api/v1/orders/', $order);
        $response->assertStatus(400);
    }
    public function test_update_order_returns_a_successful_response()
    {
        $order = Order::factory()->create();
        $updatedData = ['type' => 'Updated Type ' . $order->id + 1];
        $response = $this->putJson('/api/v1/orders/' . $order->id, $updatedData);

        $data = [
            'data' => [
                'id' => $order->id,
                'client_id' => $order->client_id,
                'auto_id' => $order->auto_id,
                'type' => $updatedData['type'],
                'startPoint' => $order->startPoint,
                'finishPoint' => $order->finishPoint,
                'distance' => $order->distance,
                'time' => $order->time,
            ],
        ];

        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('orders', $updatedData);
    } 
    public function test_update_order_returns_a_not_found_response()
    {
        $order = Order::factory()->create();
        $updatedData = ['type' => 'Updated Type ' . $order->id + 1];
        $response = $this->putJson('/api/v1/orders/' . $order->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_update_order_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['type' => 'Updated Type'];
        $response = $this->putJson('/api/v1/orders/sdfh', $updatedData);
        $response->assertStatus(400);
    }//------
    public function test_patch_order_returns_a_successful_response()
    {
        $order = Order::factory()->create();
        $updatedData = ['type' => 'Updated Type ' . $order->id + 1];
        $response = $this->patchJson('/api/v1/orders/' . $order->id, $updatedData);
        $data = [
            'data' => [
                'id' => $order->id,
                'client_id' => $order->client_id,
                'auto_id' => $order->auto_id,
                'type' => $updatedData['type'],
                'startPoint' => $order->startPoint,
                'finishPoint' => $order->finishPoint,
                'distance' => $order->distance,
                'time' => $order->time,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('orders', $updatedData);
    }
    public function test_patch_order_returns_a_not_found_response()
    {
        $order = Order::factory()->create();
        $updatedData = ['type' => 'Updated Type ' . $order->id + 1];
        $response = $this->patchJson('/api/v1/orders/' . $order->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_patch_order_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['type' => 'Updated Type'];
        $response = $this->patchJson('/api/v1/orders/jhgj', $updatedData);
        $response->assertStatus(400);
    }
    public function test_delete_order_returns_a_successful_response()
    {
        $order = Order::factory()->create();
        $response = $this->deleteJson('/api/v1/orders/' . $order->id);
        $data = [
            'data' => [
                'id' => $order['id'],
                'client_id' => $order['client_id'],
                'auto_id' => $order['auto_id'],
                'type' => $order['type'],
                'startPoint' => $order['startPoint'],
                'finishPoint' => $order['finishPoint'],
                'distance' => $order['distance'],
                'time' => $order['time'],
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_delete_order_returns_a_not_found_response()
    {
        $order = Order::factory()->create();
        $response = $this->deleteJson('/api/v1/orders/' . $order->id + 1);
        $response->assertStatus(404);
    }
    public function test_delete_order_returns_a_bad_request_response()
    {
        $response = $this->deleteJson('/api/v1/orders/sdfg');
        $response->assertStatus(400);
    }
}