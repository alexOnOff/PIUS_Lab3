<?php

namespace App\Domain\Autos\Actions;

use App\Domain\Autos\Models\Auto;

class GetAllAutoAction
{
    public function execute(): array
    {
        return Auto::all()->toArray();
    }
}