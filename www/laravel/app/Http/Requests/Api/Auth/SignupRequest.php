<?php

namespace App\Http\Requests\Api\Auth;

use App\Consts\ValidationRegex;
use App\Rules\OnlyLatinCharacterAndNumbers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(schema="SignupRequest",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="name", type="string", nullable=true, example="name"),
 *     @OA\Property(property="email", type="string", example="email@mail.com"),
 *     @OA\Property(property="password", type="string", example="p@ssw0rd"),
 * )
 */
class SignupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:' . ValidationRegex::NAME_REGEX,
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->whereNull('deleted_at')
            ],
            'password' => [
                'required',
                'string',
                new OnlyLatinCharacterAndNumbers(),
                'min:6',
                'max:255',
            ],
        ];
    }
}
