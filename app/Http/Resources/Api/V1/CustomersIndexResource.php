<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomersIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'code' =>$this->code ,
            'type' => 'customer',
            'active_phone' => $this->active_phone,
            'created_at' => $this->created_at->format('Y-m-d'),
            'api_token'=> $this->api_token
        ];
    }
}
