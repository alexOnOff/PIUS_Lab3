<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Autos\Models\Auto;
use Illuminate\Contracts\Filesystem\Cloud;

class AutoTest extends TestCase
{
    public function test_get_all_autos_returns_a_successful_response()
    {
        $response = $this->get('/api/v1/autos');

        $response->assertStatus(200);
    }

    public function test_get_auto_by_id_returns_a_successful_response()
    {
        $auto = Auto::factory()->create();
        $response = $this->get('/api/v1/autos/' . $auto->id);

        $data = [
            'data' => [
                'id' => $auto->id,
                'name' => $auto->mark,
                'cost' => $auto->cost,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_get_auto_by_id_returns_a_bad_request_response()
    {
        $response = $this->get('/api/v1/autos/skdsjgn');
        $response->assertStatus(400);
    }
    public function test_get_auto_by_id_returns_a_not_found_response()
    {
        $auto = Auto::factory()->create();
        $response = $this->get('/api/v1/autos/' . $auto->id + 1);
        $response->assertStatus(404);
    }
    public function test_create_auto_returns_a_successful_response()
    {
        $auto = Auto::factory()->raw();
        $response = $this->postJson('/api/v1/autos/', $auto);
        $data = [
            'data' => [
                'mark' => $auto['mark'],
                'cost' => $auto['cost'],
            ],
        ];
        $response->assertStatus(201)->assertJson($data);
        $this->assertDatabaseHas('autos', $auto);
    }
    public function test_create_auto_returns_a_bad_request_response()
    {
        $auto = Auto::factory()->raw();
        $this->postJson('/api/v1/autos/', $auto);

        $response = $this->postJson('/api/v1/autos/', $auto);
        $response->assertStatus(400);
    }
    public function test_update_auto_returns_a_successful_response()
    {
        $auto = Auto::factory()->create();
        $updatedData = ['mark' => 'Updated Mark ' . $auto->id + 1];
        $response = $this->putJson('/api/v1/autos/' . $auto->id, $updatedData);
        $data = [
            'data' => [
                'id' => $auto->id,
                'mark' => $updatedData['mark'],
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('autos', $updatedData);
    }
    public function test_update_auto_returns_a_not_found_response()
    {
        $auto = Auto::factory()->create();
        $updatedData = ['mark' => 'Updated Mark ' . $auto->id + 1];
        $response = $this->putJson('/api/v1/autos/' . $auto->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_update_auto_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['mark' => 'Updated Mark'];
        $response = $this->putJson('/api/v1/autos/sdfh', $updatedData);
        $response->assertStatus(400);
    }
    public function test_patch_auto_returns_a_successful_response()
    {
        $auto = Auto::factory()->create();
        $updatedData = ['mark' => 'Updated Mark ' . $auto->id + 1];
        $response = $this->patchJson('/api/v1/autos/' . $auto->id, $updatedData);
        $data = [
            'data' => [
                'id' => $auto->id,
                'mark' => $updatedData['mark'],
                'cost' => $auto->cost,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('autos', $updatedData);
    }
    public function test_patch_auto_returns_a_not_found_response()
    {
        $auto = Auto::factory()->create();
        $updatedData = ['mark' => 'Updated Mark ' . $auto->id + 1];
        $response = $this->patchJson('/api/v1/autos/' . $auto->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_patch_auto_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['mark' => 'Updated Mark'];
        $response = $this->patchJson('/api/v1/autos/jhgj', $updatedData);
        $response->assertStatus(400);
    }
    public function test_delete_auto_returns_a_successful_response()
    {
        $auto = Auto::factory()->create();
        $response = $this->deleteJson('/api/v1/autos/' . $auto->id);
        $data = [
            'data' => [
                'id' => $auto['id'],
                'mark' => $auto['mark'],
                'cost' => $auto['cost'],
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_delete_auto_returns_a_not_found_response()
    {
        $auto = Auto::factory()->create();
        $response = $this->deleteJson('/api/v1/autos/' . $auto->id + 1);
        $response->assertStatus(404);
    }
    public function test_delete_auto_returns_a_bad_request_response()
    {
        $response = $this->deleteJson('/api/v1/autos/sdfg');
        $response->assertStatus(400);
    }
}