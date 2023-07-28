<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:100',
        ];
    }
}
