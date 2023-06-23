<?php

namespace App\Http\Requests;

class StoreCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
        ];
    }

}
