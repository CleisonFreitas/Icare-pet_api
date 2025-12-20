<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use App\Models\Pet\Pet;
use Illuminate\Support\Facades\DB;

class ClientPetSave
{
    public function __construct(
        private readonly AddressRegister $serviceAddressRegister
    ) {}

    public function register(Client $client, array $data): void
    {
        DB::beginTransaction();
        $addressData = data_get($data, 'address', []);

        if (!empty($addressData)) {
            $addressMapped = array_merge($addressData, ['client_id' => $client->id]);
            $this->serviceAddressRegister->register($addressMapped);
        }

        $petData = data_get($data, 'pets', []);
        if (empty($petData)) {
            throw new \Exception('É necessário cadastrar ao menos um pet');
        }

        $petMapped = array_map(fn($data) => [...$data, 'client_id' => $client->id], $petData);
        Pet::upsert($petMapped, 'id', ['name', 'specie_id', 'size', 'color']);
        $client->register_completed = true;
        $client->save();
        DB::commit();
    }
}