<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Enums\Pets\StatusScheduleEnum;
use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientScheduleListService
{
    /**
     * Service responsible for showing a list of schedules from customer.
     * 
     * @param Client $client
     * @return Collection
     */
    public function list(Client $client): Collection
    {
        return $client
            ->schedules()
            ->whereIn('status', [
                StatusScheduleEnum::OPEN,
                StatusScheduleEnum::PENDING,
                StatusScheduleEnum::CONFIRMED,
            ])
            ->orderBy('scheduled_date')
            ->get();
    }
}
