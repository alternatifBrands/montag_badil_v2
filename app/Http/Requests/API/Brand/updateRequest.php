<?php

namespace App\Http\Requests\API\Brand;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'founder' => ['sometimes', 'string'],
            'owner' => ['sometimes', 'string'],
            'url' => ['sometimes', 'url'],
            'description' => ['sometimes', 'string'],
            'parent_company' => ['sometimes', 'string'],
            'industry' => ['sometimes', 'string'],
            'notes' => ['sometimes', 'string'],
            'is_alternative' => ['sometimes', 'boolean'],
            'barcode' => ['sometimes', 'string'],
            'image' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:90000'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'country_id' => ['sometimes', Rule::exists('countries', 'id')],
            'city_id' => ['sometimes', Rule::exists('cities', 'id')],
            'category_id' => ['sometimes', Rule::exists('categories', 'id')],
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth('api')->user()->id,
        ]);
    }
}
