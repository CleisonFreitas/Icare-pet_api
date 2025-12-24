<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'client_id' => $this->client->getKey(),
            'pet_id' => $this->pet->getKey(),
            'scheduled_date' => $this->scheduled_date,
            'service_type' => $this->service_type,
            'status' => $this->status,
        ];
    }
}
