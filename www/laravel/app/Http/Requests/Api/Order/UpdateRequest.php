<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(schema="UpdateRequest",
 *     required={"id", "full_price", "address"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="full_price", type="integer", example=12300),
 *     @OA\Property(property="address", type="string", example="p@ssw0rd"),
 * )
 */
class UpdateRequest extends FormRequest
{
    public function rules()
    {
        $userId = Auth::id();
        return [
            'id' => [
                'required',
                'integer',
                'min:1',
                "exists:orders,id,user_id,$userId",
            ],
            'full_price' => 'required|integer|min:1',
            'address' => 'required|string',
        ];
    }
}
