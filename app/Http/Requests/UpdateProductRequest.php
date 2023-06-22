<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use function array_merge;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(Product::rules(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255|min:3|unique:products,name,' . $this->product->id,
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);
    }
}
