<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $with = ["message" => "User"];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                => $this->id,
            "name"              => $this->name,
            "email"             => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "lat"               => $this->latitude,
            "lng"               => $this->longitude,
            "remember_token"    => $this->remember_token,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at
        ];
    }
}
