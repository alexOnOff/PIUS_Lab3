<?php

namespace App\Domain\Autos\Actions;

use App\Domain\Autos\Models\Auto;

class ReplaceAutoAction 
{
    public function execute(int $autoId, array $fields): Auto
    {
        $auto = Auto::findOrFail($autoId);
        $auto->update($fields);
        return $auto;
    }
}