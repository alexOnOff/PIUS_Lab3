<?php

namespace App\Domain\Clients\Actions;

use App\Domain\Clients\Models\Client;

class DeleteClientAction
{
    public function execute(int $clientId)
    {
        $client = Client::findOrFail($clientId);
        $client->delete();
        return $client;
    }
}