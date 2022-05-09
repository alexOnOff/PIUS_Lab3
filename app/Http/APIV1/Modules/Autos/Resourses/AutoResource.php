<?php 

namespace App\Http\ApiV1\Modules\Autos\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class AutoResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mark' => $this->mark,
            'cost' => $this->cost,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}