<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        if ($this->isMethod('post')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            $rules['email'] = ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)];
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }

        return $rules;
    }
}
