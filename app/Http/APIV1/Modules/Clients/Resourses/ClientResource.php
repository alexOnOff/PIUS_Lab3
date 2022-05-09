<?php 

namespace App\Http\ApiV1\Modules\Clients\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class ClientResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->phone,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}