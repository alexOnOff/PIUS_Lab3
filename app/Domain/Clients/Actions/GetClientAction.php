<?php 

namespace App\Domain\Clients\Actions;

use App\Domain\Clients\Models\Client;

class GetClientAction
{
    public function execute(int $buyerId): Client
    {
        return Client::findOrFail($buyerId);
    }
}