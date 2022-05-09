<?php 

namespace App\Http\ApiV1\Modules\Orders\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class OrderResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->shop_id,
            'startPoint' => $this->buyer_id,
            'finishPoint' => $this->item_id,
            'distance' => $this->quanity,
            'time' => $this->order_discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}