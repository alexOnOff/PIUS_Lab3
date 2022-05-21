<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Autos\Models\Auto;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get auto - 200', function () { // ok
    Auto::factory()->count(2)->create();
    $response = getJson('/api/v1/autos');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data',2)
        );
});

it('get autos with not found response - 404', function () { // ok
    $response = getJson('/api/v1/sdfgsdfg');
    $response->assertStatus(404);
});

it('get auto by id - 200', function () {
    $auto = Auto::factory()->create();
    $response = getJson('/api/v1/autos/' . $auto->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $auto->id)
            ->where('mark', $auto->mark)
            ->where('cost', $auto->cost)
            ));
});

it('get auto by id with not found response - 404', function () {
    $auto = Auto::factory()->create();
    $response = getJson('/api/v1/autos/' . $auto->id+1);
    $response->assertStatus(404);
});

it('post auto - 201', function () {
    $auto = Auto::factory()->raw();
    $response = postJson('/api/v1/autos', $auto);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
            ->where('mark', $auto['mark'])
            ->where('cost', $auto['cost'])
        ));
    $this->assertDatabaseHas('autos', $auto);
});

it('post auto with not found response - 404', function () { //ok
    $auto = Auto::factory()->raw();
    $response = postJson('/api/v1/thysrt', $auto);
    $response->assertStatus(404);
});

it('post auto with bad unprocessable entity(seems like bad request) response - 422', function () { // ok
    $auto = Auto::factory()->raw();
    $auto['mark'] = null;
    $response = postJson('/api/v1/autos', $auto);
    $response->assertStatus(422);
});

it('delete auto - 200', function () {
    $auto = Auto::factory()->create();
    $response = deleteJson('/api/v1/autos/'. $auto->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('autos', $auto->attributesToArray());
});

it('delete auto by id with not found response - 404', function () { // ok
    $auto = Auto::factory()->create();
    $response = deleteJson('/api/v1/sdfgsdf/'. $auto->id);
    $response->assertStatus(404);
});

it('put auto - 200', function () {
    $auto = Auto::factory()->create();
    $putAuto = Auto::factory()->raw();
    $response = putJson('/api/v1/autos/'. $auto->id, $putAuto);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $auto->id)
            ->where('mark', $auto['mark'])
            ->where('cost', $auto['cost'])
        ));
    $this->assertDatabaseHas('autos', $putAuto);
});

it('put auto by id with not found response - 404', function () { // ok
    $auto = Auto::factory()->create();
    $putAuto = Auto::factory()->raw();
    $response = putJson('/api/v1/sdfg/'. $auto->id, $putAuto);
    $response->assertStatus(404);
});

it('put auto by id with bad request response - 422', function () { // ok
    $auto = Auto::factory()->create();
    $putAuto = Auto::factory()->raw();
    $putAuto['mark'] = null;
    $response = putJson('/api/v1/autos/'. $auto->id, $putAuto);
    $response->assertStatus(422);
});

it('patch auto - 200', function () {
    $auto = Auto::factory()->create();
    $patchAuto = Auto::factory()->raw();
    $response = patchJson('/api/v1/autos/'. $auto->id, $patchAuto);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $auto->id)
            ->where('mark', $auto['mark'])
            ->where('cost', $auto['cost'])
        ));
    $this->assertDatabaseHas('autos', $patchAuto);
});

it('patch auto by id with not found response - 404', function () { // ok
    $auto = Auto::factory()->create();
    $patchAuto = Auto::factory()->raw();
    $response = putJson('/api/v1/asfgdftyumkui/'. $auto->id, $patchAuto);
    $response->assertStatus(404);
});

it('patch auto by id with bad request response - 422', function () { // ok
    $auto = Auto::factory()->create();
    $patchAuto = Auto::factory()->raw();
    $patchClient['mark'] = null;
    $response = patchJson('/api/v1/autos/'. $auto->id, $patchAuto);
    $response->assertStatus(422);
});