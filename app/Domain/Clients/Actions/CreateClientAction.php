<?php 

namespace App\Domain\Clients\Actions;

use App\Domain\Clients\Models\Client;

class CreateClientAction
{
    public function execute(array $fields): Client
    {
        return Client::create($fields);
    }
}