<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     schema="ValidateUserUpdateRequest",
 *     description="Request schema for updating a new user.",
 *     required={"name"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the user.",
 *         example="Administrator"
 *     ),
*     @OA\Property(
 *         property="email",
 *         type="email",
 *         description="The email of the user. (email format)",
 *         example="user@example.com"
 *     ),
 *      @OA\Property(
 *         property="rol_id",
 *         type="int",
 *         description="The rol_id of the user. ",
 *         example="1"
 *     ),
 *     @OA\Tag(
 *         name="ValidateUserStoreRequest",
 *         description="Request for updating a new user."
 *     )
 * )
 */

class ValidateUserUpdateRequest extends FormRequest
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

        $userId = $this->route('user')->id;

        $rules = [

            'name' => 'alpha|required|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'rol_id' => 'required|exists:rols,id',
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
