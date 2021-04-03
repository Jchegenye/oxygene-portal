<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'verified' => $request->user()->hasVerifiedEmail(),
            'created_at' => $this->created_at,
            'role_id' => $request->user()->roles->id,
            'role_label' => $request->user()->roles->label,
            // profile
            'phone_number' => $request->user()->profiles ? $request->user()->profiles->phone_number : null,
        ];
    }
}
