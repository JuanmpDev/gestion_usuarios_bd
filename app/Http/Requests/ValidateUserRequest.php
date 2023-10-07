<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRequest extends FormRequest
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
        'inputName' => 'required|max:255',
        'role' => 'required|exists:rols,id',
    ];

    if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
        // Si el método es PUT o PATCH, estamos actualizando el usuario
        $userId = $this->route('user')->id; // Asegúrate de que 'user' sea el nombre correcto del parámetro de ruta.
        $rules['inputEmail'] = 'required|email|unique:users,email,' . $userId;
    } else {
        // Si no, estamos creando un nuevo usuario
        $rules['inputEmail'] = 'required|email|unique:users,email';
    }

    return $rules;
}

}
