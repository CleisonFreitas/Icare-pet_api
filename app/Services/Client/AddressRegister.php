<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Facades\SaveRecordFacade;
use App\Models\Client\Address;

class AddressRegister
{
    public function register(array $data): Address
    {
        $model = new Address;
        $addressCreated = SaveRecordFacade::save($model, $data);
        return $addressCreated;
    }
}