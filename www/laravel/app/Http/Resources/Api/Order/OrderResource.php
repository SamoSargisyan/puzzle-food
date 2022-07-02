<?php

namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="OrderResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="order_id", type="string", example="018uh4r193478hry"),
 *     @OA\Property(property="full_price", type="integer", example=12300),
 *     @OA\Property(property="address", type="string", example="Tyumen"),
 *     @OA\Property(property="created_at", type="string", example="2021-07-01 09:16:56"),
 * )
 */
class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'order_id' => $this->order_id,
            'full_price' => $this->full_price,
            'address' => $this->address,
            'created_at' => $this->created_at,
        ];
    }
}
