<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;


use App\Models\Ratting;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserProfileCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'name'               => $this->name ?? '',
            'mobile'             => $this->mobile ?? '',
            'status'            => $this->status
        ];
    }
}
