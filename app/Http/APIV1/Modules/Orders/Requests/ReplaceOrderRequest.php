<?php 

namespace App\Http\ApiV1\Modules\Orders\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
class ReplaceOrderRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'auto_id' => 'integer',
            'client_id' => 'integer',
            'startPoint' => 'string',
            'distance' => 'integer',
            'finishPoint' => 'string',
            'time' => 'date',
            'type' => 'string',
        ];
    }
}
