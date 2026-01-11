<?php

namespace Tests\Feature\Http\Controllers\App;

use App\Models\Client\Address;
use App\Models\Client\Contact;
use App\Models\Pet\Pet;
use App\Models\Pet\Specie;
use App\Services\Client\ClientPetSave;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClientPetControllerTest extends TestCase
{
    #[Test]
    public function register(): void
    {
        Event::fake();
        $client = $this->actionAsClient();

        $uri = 'api/v1/app/client/%s/pet/register';
        $api = sprintf($uri, $client->getKey());

        $data = [];
        $address = Address::factory()
            ->make(['client_id' => null])
            ->toArray();
        $contact = [
            0 => Contact::factory()
                    ->make(['client_id' => null])
                    ->toArray()
        ];
        $specie = Specie::factory()->create();
        $pet = [
            0 => Pet::factory()
                ->for($specie)
                ->make([])
                ->toArray()
        ];
        $data = array_merge($data, [
            'address' => $address,
            'contacts' => $contact,
            'pets' => $pet
        ]);

        $response = $this->postJson($api, $data);
        $response->assertCreated();
        Event::assertDispatched(ClientPetSave::class);
    }
}
