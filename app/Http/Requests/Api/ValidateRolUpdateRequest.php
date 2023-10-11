<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     schema="ValidateRolUpdateRequest",
 *     description="Request schema for updating a new role.",
 *     required={"name"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the role.",
 *         example="User"
 *     ),
 *     @OA\Tag(
 *         name="ValidateRolUpdateRequest",
 *         description="Request for updating a new role."
 *     )
 * )
 */

class ValidateRolUpdateRequest extends FormRequest
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
