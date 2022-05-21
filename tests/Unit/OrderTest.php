<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Orders\Models\Order;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get orders - 200', function () {  //ok
    Order::factory()->count(2)->create();
    $response = getJson('/api/v1/orders');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data',2)
        );
});

it('get orders with not found response - 404', function () { //ok
    $response = getJson('/api/v1/sdfgsdfg');
    $response->assertStatus(404);
});

it('get order by id - 200', function () { // ok
    $order = Order::factory()->create();
    $response = getJson('/api/v1/orders/' . $order->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $order->id)
            ->where('type', $order->type)
            ->where('startPoint', $order->startPoint)
            ->where('finishPoint', $order->finishPoint)
            ->where('distance', $order->distance)
            ->where('time', $order->time)
            ->where('client_id', $order->client_id)
            ->where('auto_id', $order->auto_id)
            ));
});

it('get order by id with not found response - 404', function () { //ok
    $order = Order::factory()->create();
    $response = getJson('/api/v1/orders/' . $order->id+1);
    $response->assertStatus(404);
});

it('post order - 201', function () {
    $order = Order::factory()->raw();
    $response = postJson('/api/v1/orders', $order);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
        ->where('type', $order['type'])
        ->where('startPoint', $order['startPoint'])
        ->where('finishPoint', $order['finishPoint'])
        ->where('distance', $order['distance'])
        ->where('time', $order['time'])
       // ->where('client_id', $order['client_id'])
       // ->where('auto_id', $order['auto_id'])
        ));
    $this->assertDatabaseHas('orders', $order);
});

it('post order with not found response - 404', function () { //ok
    $order = Order::factory()->raw();
    $response = postJson('/api/v1/thysrt', $order);
    $response->assertStatus(404);
});

it('post order with bad unprocessable entity(seems like bad request) response - 422', function () { // ok
    $order = Order::factory()->raw();
    $order['type'] = null;
    $response = postJson('/api/v1/clients', $order);
    $response->assertStatus(422);
});

it('delete order - 200', function () { // ok
    $order = Order::factory()->create();
    $response = deleteJson('/api/v1/orders/'. $order->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('orders', $order->attributesToArray());
});

it('delete order by id with not found response - 404', function () { // ok
    $order = Order::factory()->create();
    $response = deleteJson('/api/v1/sdfgsdf/'. $order->id);
    $response->assertStatus(404);
});

it('put order - 200', function () {
    $order = Order::factory()->create();
    $putOrder = Order::factory()->raw();
    $response = putJson('/api/v1/orders/'. $order->id, $putOrder);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $order->id)
            ->where('type', $order['type'])
            ->where('startPoint', $order['startPoint'])
            ->where('finishPoint', $order['finishPoint'])
            ->where('distance', $order['distance'])
            ->where('time', $order['time'])
           // ->where('client_id', $order['client_id'])
           // ->where('auto_id', $order['auto_id'])
        ));
    $this->assertDatabaseHas('orders', $putOrder);
});

it('put order by id with not found response - 404', function () { // ok
    $order = Order::factory()->create();
    $putOrder = Order::factory()->raw();
    $response = putJson('/api/v1/sdfg/'. $order->id, $putOrder);
    $response->assertStatus(404);
});

it('put order by id with bad request response - 422', function () { // ok
    $order = Order::factory()->create();
    $putOrder = Order::factory()->raw();
    $putOrder['type'] = null;
    $response = putJson('/api/v1/orders/'. $order->id, $putOrder);
    $response->assertStatus(422);
});

it('patch order - 200', function () {
    $order = Order::factory()->create();
    $patchOrder = Order::factory()->raw();
    $response = patchJson('/api/v1/orders/'. $order->id, $patchOrder);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $order->id)
            ->where('type', $order['type'])
            ->where('startPoint', $order['startPoint'])
            ->where('finishPoint', $order['finishPoint'])
            ->where('distance', $order['distance'])
            ->where('time', $order['time'])
           // ->where('client_id', $order['client_id'])
           // ->where('auto_id', $order['auto_id'])
        ));
    $this->assertDatabaseHas('orders', $patchOrder);
});

it('patch order by id with not found response - 404', function () { // ok
    $order = Order::factory()->create();
    $patchOrder = Order::factory()->raw();
    $response = putJson('/api/v1/asfgdftyumkui/'. $order->id, $patchOrder);
    $response->assertStatus(404);
});

it('patch order by id with bad request response - 422', function () { // ok
    $order = Order::factory()->create();
    $patchOrder = Order::factory()->raw();
    $patchOrder['type'] = null;
    $response = patchJson('/api/v1/orders/'. $order->id, $patchOrder);
    $response->assertStatus(422);
});