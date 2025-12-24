<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientPetListService
{
    /**
     * Service responsible for returning the list of
     * pets from customer available for appointment.
     *
     * @param Client $client
     * @return Collection
     */
    public function list(Client $client): Collection
    {
        return $client->pets()
            ->whereActive(true)
            ->get();
    }
}
