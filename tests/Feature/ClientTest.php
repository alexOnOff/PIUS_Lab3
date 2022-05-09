<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Clients\Models\Client;
use Illuminate\Contracts\Filesystem\Cloud;

class ClientTest extends TestCase
{
    public function test_get_all_clients_returns_a_successful_response()
    {
        $response = $this->get('/api/v1/clients');

        $response->assertStatus(200);
    }

    public function test_get_client_by_id_returns_a_successful_response()
    {
        $client = Client::factory()->create();
        $response = $this->get('/api/v1/clients/' . $client->id);

        $data = [
            'data' => [
                'id' => $client->id,
                'name' => $client->name,
                'surname' => $client->surname,
                'email' => $client->email,
                'password' => $client->password,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_get_client_by_id_returns_a_bad_request_response()
    {
        $response = $this->get('/api/v1/clients/skdsjgn');
        $response->assertStatus(400);
    }
    public function test_get_client_by_id_returns_a_not_found_response()
    {
        $client = Client::factory()->create();
        $response = $this->get('/api/v1/clients/' . $client->id + 1);
        $response->assertStatus(404);
    }
    public function test_create_client_returns_a_successful_response()
    {
        $client = Client::factory()->raw();
        $response = $this->postJson('/api/v1/clients/', $client);
        $data = [
            'data' => [
                'id' => $client['id'],
                'name' => $client['name'],
                'surname' => $client['surname'],
                'email' => $client['email'],
                'password' => $client['password'],
            ],
        ];
        $response->assertStatus(201)->assertJson($data);
        $this->assertDatabaseHas('clients', $client);
    }
    public function test_create_client_returns_a_bad_request_response()
    {
        $client = Client::factory()->raw();
        $this->postJson('/api/v1/clients/', $client);

        $response = $this->postJson('/api/v1/clients/', $client);
        $response->assertStatus(400);
    }
    public function test_update_client_returns_a_successful_response()
    {
        $client = Client::factory()->create();
        $updatedData = ['name' => 'Updated Name ' . $client->id + 1];
        $response = $this->putJson('/api/v1/clients/' . $client->id, $updatedData);

        $data = [
            'data' => [
                'id' => $client->id,
                'name' => $updatedData['name'],
                'surname' => $client->surname,
                'email' => $client->email,
                'password' => $client->password,
            ],
        ];

        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('clients', $updatedData);
    } 
    public function test_update_client_returns_a_not_found_response()
    {
        $client = Client::factory()->create();
        $updatedData = ['name' => 'Updated Name ' . $client->id + 1];
        $response = $this->putJson('/api/v1/clients/' . $client->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_update_client_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['name' => 'Updated Name'];
        $response = $this->putJson('/api/v1/clients/sdfh', $updatedData);
        $response->assertStatus(400);
    }
    public function test_patch_client_returns_a_successful_response()
    {
        $client = Client::factory()->create();
        $updatedData = ['name' => 'Updated Name ' . $client->id + 1];
        $response = $this->patchJson('/api/v1/clients/' . $client->id, $updatedData);
        $data = [
            'data' => [
                'id' => $client->id,
                'name' => $updatedData['name'],
                'surname' => $client->surname,
                'email' => $client->email,
                'password' => $client->password,
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
        $this->assertDatabaseHas('clients', $updatedData);
    }
    public function test_patch_client_returns_a_not_found_response()
    {
        $client = Client::factory()->create();
        $updatedData = ['name' => 'Updated Name ' . $client->id + 1];
        $response = $this->patchJson('/api/v1/clients/' . $client->id + 1, $updatedData);
        $response->assertStatus(404);
    }
    public function test_patch_client_invalid_url_returns_a_bad_request_response()
    {
        $updatedData = ['name' => 'Updated Name'];
        $response = $this->patchJson('/api/v1/clients/jhgj', $updatedData);
        $response->assertStatus(400);
    }
    public function test_delete_client_returns_a_successful_response()
    {
        $client = Client::factory()->create();
        $response = $this->deleteJson('/api/v1/clients/' . $client->id);
        $data = [
            'data' => [
                'id' => $client['id'],
                'name' => $client['name'],
                'surname' => $client['surname'],
                'email' => $client['email'],
                'password' => $client['password'],
            ],
        ];
        $response->assertStatus(200)->assertJson($data);
    }
    public function test_delete_client_returns_a_not_found_response()
    {
        $client = Client::factory()->create();
        $response = $this->deleteJson('/api/v1/clients/' . $client->id + 1);
        $response->assertStatus(404);
    }
    public function test_delete_client_returns_a_bad_request_response()
    {
        $response = $this->deleteJson('/api/v1/clients/sdfg');
        $response->assertStatus(400);
    }
}