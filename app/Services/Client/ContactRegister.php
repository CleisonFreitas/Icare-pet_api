<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use App\Models\Client\Contact;

class ContactRegister
{
    /**
     * Service responsible for register customers contact
     * @param Client $client
     * @param array $data
     * @return void
     */
    public function register(Client $client, array $data): void
    {
        $contacts = array_key_exists('contacts', $data)
            ? data_get($data, 'contacts')
            : $data;
        $dataMapped = array_map(function($arr) use($client) {
            return [
                'id' => data_get($arr, 'id'),
                'name' => data_get($arr, 'name'),
                'type' => data_get($arr, 'type'),
                'value' => data_get($arr, 'value'),
                'client_id' => $client->id
            ];
        }, $contacts);
        Contact::upsert($dataMapped, ['id'], ['type', 'value', 'name']);
    }
}