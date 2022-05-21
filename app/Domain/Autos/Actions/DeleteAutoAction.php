<?php

namespace App\Domain\Autos\Actions;

use App\Domain\Autos\Models\Auto;

class DeleteAutoAction
{
    public function execute(int $autoId)
    {
        $auto = Auto::findOrFail($autoId);
        $auto->delete();
        return $auto;
    }
}