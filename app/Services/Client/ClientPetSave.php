<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use App\Models\Pet\Pet;
use Exception;
use Illuminate\Support\Facades\DB;

class ClientPetSave
{
    public function __construct(
        private readonly AddressRegister $serviceAddressRegister,
        private readonly ContactRegister $serviceContactRegister,
    ) {}

    public function register(Client $client, array $data): void
    {
        DB::beginTransaction();

        $this->addressStore($client, $data);
        $this->contactStore($client, $data);

        $petData = data_get($data, 'pets', []);
        if (empty($petData)) {
            throw new Exception('É necessário cadastrar ao menos um pet');
        }

        $petMapped = array_map(fn($data) => [
            ...$data,
            'client_id' => $client->id
        ], $petData);
        Pet::upsert($petMapped, 'id', ['name', 'specie_id', 'size', 'color']);
        $client->register_completed = true;
        $client->save();
        DB::commit();
    }

    private function addressStore(Client $client, array $data): void
    {
        $addressData = data_get($data, 'address', []);

        // Address register
        if (empty($addressData)) {
            throw new Exception('É necessário informar um endereço');
        }
        $addressMapped = array_merge($addressData, ['client_id' => $client->id]);
        $this->serviceAddressRegister->register($addressMapped);
    }

    private function contactStore(Client $client, array $data): void
    {
        // Contact Register
        $contactData = data_get($data, 'contacts', []);
        if (empty($contactData)) {
            throw new Exception('Ao menos um contato deve ser informado');
        }
        $this->serviceContactRegister->register($client, $contactData);
    }
}
