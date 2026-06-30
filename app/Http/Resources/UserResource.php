<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            // ⚠ KHÔNG include email và password!
            // Chỉ include email nếu user đang xem profile của chính họ
            'email' => $this->when(
                $request->user()?->id === $this->id,
                $this->email
            ),
        ];
    }
}