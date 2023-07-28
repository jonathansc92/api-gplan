<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'email|nullable|max:100',
            'phone' => 'nullable|max:20',
            'whatsapp' => 'nullable|max:20',
            'person_id' => 'required|exists:persons,id',
        ];
    }
}
