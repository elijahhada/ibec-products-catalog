<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'is_paid' => $this->is_paid,
            'email'   => $this->email,
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'items'   => CartItemResource::collection($this->items),
        ];
    }
}
