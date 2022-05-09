<?php 

namespace App\Http\ApiV1\Modules\Autos\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
class PatchAutoRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'mark' => 'string|max:100',
            'cost' => 'integer',
        ];
    }
}