<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     schema="ValidateUserStoreRequest",
 *     description="Request schema for storing a new user.",
 *     required={"name"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the user. (Only letters)",
 *         example="Administrator"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="email",
 *         description="The email of the user. (email format)",
 *         example="user@example.com"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="The password of the user. (minimum 8 letters, at least 1 letter, 1 number and 1 alphanumeric [!$#%@])",
 *         example="Administrador1@"
 *     ),
 *      @OA\Property(
 *         property="password_confirmed",
 *         type="string",
 *         description="The confirmed password of the user. (minimum 8 letters, at least 1 letter, 1 number and 1 alphanumeric [!$#%@])",
 *         example="Administrador1@"
 *     ),
 *      @OA\Property(
 *         property="rol_id",
 *         type="int",
 *         description="The rol_id of the user. ",
 *         example="1"
 *     ),
 *     @OA\Tag(
 *         name="ValidateUserStoreRequest",
 *         description="Request for storing a new user."
 *     )
 * )
 */

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
    public function rules(): array
    {
        $rules = [
            'name' => 'alpha|required|max:255',
            'email' => 'required|email|unique:users,email',
            'rol_id' => 'required|exists:rols,id',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/'],
        ];

        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}

