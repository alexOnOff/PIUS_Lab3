<?php

namespace App\Domain\Autos\Actions;

use App\Domain\Autos\Models\Auto;

class GetAutoAction
{
    public function execute(int $autoId): Auto
    {
        return Auto::findOrFail($autoId);
    }
}