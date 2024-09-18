<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            "id"=> $this->id,
            "displayName"=> $this->displayName,
            "email"=> $this->email,
            "email_verified_at"=> $this->email_verified_at,
            "profile_picture" => $this->profile_picture,
            "created_at"=> $this->created_at ?  $this->created_at->toDateTimeString() : null,
            "updated_at"=> $this->created_at ?  $this->updated_at->toDateTimeString() : null,
        );
    }
}
