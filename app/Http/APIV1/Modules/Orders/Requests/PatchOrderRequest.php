<?php 

namespace App\Http\ApiV1\Modules\Orders\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
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