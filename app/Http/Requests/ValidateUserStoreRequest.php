<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserStoreRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'inputName' => 'alpha|required|max:255',
            'inputEmail' => 'required|email|unique:users,email',
            'role' => 'required|exists:rols,id',
            'inputPassword' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/'],
        ];

        return $rules;
    }



}

