<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
            'description' => $this->description,
            'creator' => $this->creator,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
            'user' => $this->whenLoaded('user')
        ];
    }
}
