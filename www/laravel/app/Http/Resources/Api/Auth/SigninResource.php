<?php

namespace App\Http\Resources\Api\Auth;

use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SigninResource extends JsonResource
{
    /**
     * @OA\Schema(schema="SigninResource",
     *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
     *     @OA\Property(property="token", type="string", example="240343ad66cb7c47f9cafcfe2f30539717a974267")
     * )
     */
    public function toArray($request)
    {
        return [
            'user' => UserResource::make($this['user']),
            'token' => $this['token']->accessToken->token,
        ];
    }
}
