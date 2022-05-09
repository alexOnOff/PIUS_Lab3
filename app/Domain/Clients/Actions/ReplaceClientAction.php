<?php

namespace App\Domain\Clients\Actions;

use App\Domain\Clients\Models\Client;

class ReplaceClientAction 
{
    public function execute(int $clientId, array $fields): Client
    {
        $client = Client::findOrFail($clientId);
        $client->update($fields);
        return $client;
    }
}