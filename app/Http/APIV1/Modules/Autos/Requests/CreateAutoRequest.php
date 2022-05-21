<?php 

namespace App\Http\APIV1\Modules\Autos\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class CreateAutoRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'mark' => 'required|string|max:100',
            'cost' => 'required|integer',
        ];
    }
}