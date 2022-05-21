<?php 

namespace App\Http\APIV1\Modules\Orders\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class CreateOrderRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'auto_id' => 'required|integer',
            'client_id' => 'required|integer',
            'startPoint' => 'required|string',
            'distance' => 'required|integer',
            'finishPoint' => 'required|string',
            'time' => 'required|date',
            'type' => 'required|string',
        ];
    }
}
