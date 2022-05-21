<?php 

namespace App\Http\APIV1\Modules\Orders\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
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
