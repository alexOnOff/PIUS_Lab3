<?php 

namespace App\Http\APIV1\Modules\Clients\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class ReplaceClientRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:100',
            'surname' => 'string|max:100',
            'email' => 'string',
            'password' => 'string|max:50',
        ];
    }
}