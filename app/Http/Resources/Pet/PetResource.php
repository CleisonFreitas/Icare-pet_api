<?php

namespace App\Http\Resources\Pet;

use App\Http\Resources\Client\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'client_id' => $this->client_id,
            'specie_id' => $this->specie_id,
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'color' => $this->color,
            'microchipped' => $this->microchipped,
            'microchip_number' => $this->microchip_number,
            'registered' => $this->registered,
            'specie' => $this->whenLoaded('specie', function () {
                return [
                    'id' => $this->specie->getKey(),
                    'name' => $this->specie->name,
                    'slug' => $this->specie->slug,
                    'group' => $this->specie->group,
                ];
            }),

            'client' => $this->whenLoaded(
                'client',
                fn()
                => new ClientResource($this->client)
            ),
        ];
    }
}
