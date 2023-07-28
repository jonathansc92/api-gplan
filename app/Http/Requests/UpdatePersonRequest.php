<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'sometimes|max:100',
        ];
    }
}
