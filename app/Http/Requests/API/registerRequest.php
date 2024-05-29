<?php

namespace App\Http\Requests\API;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class registerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $userId = auth()->id();
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email'=>['required','email','string',Rule::unique('users')->ignore($userId)],
            'password' => ['required', 'min:6'],
        ];
    }
}
