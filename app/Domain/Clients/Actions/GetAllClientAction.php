<?php

namespace App\Domain\Clients\Actions;

use App\Domain\Clients\Models\Client;

class GetAllClientAction
{
    public function execute(): array
    {
        return Client::all()->toArray();
    }
}
