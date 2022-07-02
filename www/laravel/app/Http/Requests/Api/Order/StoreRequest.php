<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(schema="StoreRequest",
 *     required={"full_price", "address"},
 *     @OA\Property(property="full_price", type="integer", example=12300),
 *     @OA\Property(property="address", type="string", example="p@ssw0rd"),
 * )
 */
class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'full_price' => 'required|integer|min:1',
            'address' => 'required|string',
        ];
    }
}
