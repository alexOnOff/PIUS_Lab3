<?php 

namespace App\Http\APIV1\Modules\Orders\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class PatchOrderRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'startPoint' => 'required|string',
            'distance' => 'required|integer',
            'finishPoint' => 'required|string',
            'time' => 'required|date',
            'type' => 'required|string',
        ];
    }
}