<?php

namespace App\Http\Requests\API\Brand;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'year' => ['required', 'date'],
            'description' => ['required', 'string'],
            'notes' => ['required', 'string'],
            'is_alternative' => ['required', 'boolean'],
            'barcode' => ['sometimes', 'string'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:90000'],
            'founder' => ['sometimes', 'string'],
            'owner' => ['sometimes', 'string'],
            'url' => ['sometimes', 'url'],
            'parent_company' => ['sometimes', 'string'],
            'industry' => ['sometimes', 'string'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            // 'country_id' => ['required', Rule::exists('countries', 'id')],
            // 'city_id' => ['required', Rule::exists('cities', 'id')],
            // 'category_id' => ['required', Rule::exists('categories', 'id')],
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth('api')->user()->id,
        ]);
    }
}
