<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Pet\PetResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date->format('Y-m-d'),
            'pets' => PetResource::collection($this->pets),
        ];
    }
}
