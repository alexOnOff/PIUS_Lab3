<?php 

namespace App\Domain\Autos\Actions;

use App\Domain\Autos\Models\Auto;

class CreateAutoAction
{
    public function execute(array $fields): Auto
    {
        return Auto::create($fields);
    }
}