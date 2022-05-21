<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Clients\Models\Client;
use App\Domain\Orders\Models\Order;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get clients - 200', function () { // ok
    Client::factory()->count(2)->create();
    $response = getJson('/api/v1/clients');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data',2)
        );
});

it('get clients with not found response - 404', function () { // ok
    $response = getJson('/api/v1/sdfgsdfg');
    $response->assertStatus(404);
});


it('get client by id - 200', function () {
    $client = Client::factory()->create();
    $response = getJson('/api/v1/clients/' . $client->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $client->id)
            ->where('name', $client->name)
            ->where('surname', $client->surname)
            ->where('email', $client->email)
            ->where('password', $client->password)
            ));
});


it('get client by id with not found response - 404', function () {
    $client = Client::factory()->create();
    $response = getJson('/api/v1/clients/' . $client->id+1);
    $response->assertStatus(404);
});

it('get order by id with not found response - 404', function () {
    $client = Order::factory()->create();
    $response = getJson('/api/v1/orders/' . $client->id+1);
    $response->assertStatus(404);
});

it('post client - 201', function () {
    $client = Client::factory()->raw();
    $response = postJson('/api/v1/clients', $client);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
        ->where('name', $client['name'])
        ->where('surname', $client['surname'])
        ->where('email', $client['email'])
        ->where('password', $client['password'])
        ));
    $this->assertDatabaseHas('buyers', $client);
});

it('post client with not found response - 404', function () { //ok
    $client = Client::factory()->raw();
    $response = postJson('/api/v1/thysrt', $client);
    $response->assertStatus(404);
});

it('post client with bad unprocessable entity(seems like bad request) response - 422', function () { // ok
    $client = Client::factory()->raw();
    $client['name'] = null;
    $response = postJson('/api/v1/clients', $client);
    $response->assertStatus(422);
});

it('delete client - 200', function () {
    $client = Client::factory()->create();
    $response = deleteJson('/api/v1/clients/'. $client->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('clients', $client->attributesToArray());
});

it('delete client by id with not found response - 404', function () { // ok
    $client = Client::factory()->create();
    $response = deleteJson('/api/v1/sdfgsdf/'. $client->id);
    $response->assertStatus(404);
});

it('put client - 200', function () {
    $client = Client::factory()->create();
    $putClient = Client::factory()->raw();
    $response = putJson('/api/v1/clients/'. $client->id, $putClient);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $client->id)
            ->where('name', $client['name'])
            ->where('surname', $client['surname'])
            ->where('email', $client['email'])
            ->where('password', $client['password'])
        ));
    $this->assertDatabaseHas('clients', $putClient);
});

it('put client by id with not found response - 404', function () { // ok
    $client = Client::factory()->create();
    $putClient = Client::factory()->raw();
    $response = putJson('/api/v1/sdfg/'. $client->id, $putClient);
    $response->assertStatus(404);
});

it('put client by id with bad request response - 422', function () { // ok
    $client = Client::factory()->create();
    $putClient = Client::factory()->raw();
    $putClient['name'] = null;
    $response = putJson('/api/v1/clients/'. $client->id, $putClient);
    $response->assertStatus(422);
});

it('patch client - 200', function () {
    $client = Client::factory()->create();
    $patchClient = Client::factory()->raw();
    $response = patchJson('/api/v1/clients/'. $client->id, $patchClient);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $client->id)
            ->where('name', $client['name'])
            ->where('surname', $client['surname'])
            ->where('email', $client['email'])
            ->where('password', $client['password'])
        ));
    $this->assertDatabaseHas('clients', $patchClient);
});

it('patch client by id with not found response - 404', function () { // ok
    $client = Client::factory()->create();
    $patchClient = Client::factory()->raw();
    $response = putJson('/api/v1/asfgdftyumkui/'. $client->id, $patchClient);
    $response->assertStatus(404);
});

it('patch client by id with bad request response - 422', function () { // ok
    $client = Client::factory()->create();
    $patchClient = Client::factory()->raw();
    $patchClient['name'] = null;
    $response = patchJson('/api/v1/clients/'. $client->id, $patchClient);
    $response->assertStatus(422);
});