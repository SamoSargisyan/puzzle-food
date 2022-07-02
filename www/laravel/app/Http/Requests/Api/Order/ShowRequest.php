<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(schema="ShowRequest",
 *     required={"id"},
 *     @OA\Property(property="id", type="integer", example=1),
 * )
 */
class ShowRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|min:1|exists:orders,id',
        ];
    }
}
