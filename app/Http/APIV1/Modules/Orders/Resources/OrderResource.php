<?php 

namespace App\Http\APIV1\Modules\Orders\Resources;

use App\Http\APIV1\Support\Resources\BaseJsonResource;

class OrderResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'startPoint' => $this->startPoint,
            'finishPoint' => $this->finishPoint,
            'distance' => $this->distance,
            'time' => $this->time,
            'client_id' => $this->client_id,
            'auto_id' => $this->auto_id,
        ];
    }
}