<?php 

namespace App\Http\APIV1\Modules\Clients\Requests;

use App\Http\APIV1\Support\Requests\BaseFormRequest;
class CreateClientRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|string',
            'password' => 'required|string|max:50',
        ];
    }
}