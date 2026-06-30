<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            // 1. Fields cơ bản của Post
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug ?? null,
            'body'        => $this->body ?? $this->content,
            'status'      => $this->status,

            // 2. Computed field: user hiện tại có phải tác giả không?
            'is_author'   => $request->user()?->id === $this->user_id,

            // 3. Nested Resource – chỉ include nếu đã eager load
            'category'    => new CategoryResource($this->whenLoaded('category')),
            'author'      => new UserResource($this->whenLoaded('author')),
            'tags'        => CategoryResource::collection($this->whenLoaded('tags')),

            // 4. Timestamps chuẩn ISO 8601
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}