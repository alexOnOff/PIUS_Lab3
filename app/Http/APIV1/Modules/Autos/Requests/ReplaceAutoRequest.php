<?php 

namespace App\Http\APIV1\Modules\Autos\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class ReplaceAutoRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'mark' => 'string|max:100',
            'cost' => 'integer',
        ];
    }
}