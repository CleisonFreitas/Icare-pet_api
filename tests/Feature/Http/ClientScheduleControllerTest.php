<?php

namespace Tests\Feature\Http;

use App\Enums\Logs\App\ClientActivityLogsEnum;
use App\Enums\Pets\StatusScheduleEnum;
use App\Events\App\ClientScheduleCreated;
use App\Events\App\ClientScheduleUpdated;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClientScheduleControllerTest extends TestCase
{
    #[Test]
    public function schedule(): void
    {
        Event::fake();
        $client = $this->actionAsClient();
        $pet = Pet::factory()->for($client)->create();
        $schedule = Schedule::factory()->create([
            'client_id' => null,
            'pet_id' => null,
            'status' => StatusScheduleEnum::OPEN
        ]);
        $uri = 'api/v1/app/client/%s/pet/%s/schedule';
        $api = sprintf($uri, $client->getKey(), $pet->getKey());
        $response = $this->put($api, ['schedule_id' => $schedule->getKey()]);
        $response->assertOk();
        $response->assertJsonStructure([
            'id', 'client_id', 'pet_id', 'service_type'
        ]);

        Event::assertDispatched(ClientScheduleUpdated::class, function(ClientScheduleUpdated $event) {
            $info = $event->info;
            $this->assertEquals(
                ClientActivityLogsEnum::APP_CLIENTE_AGENDOU_CONSULTA->value,
                $info->getLogName()
            );
            $this->assertEquals(
                ClientActivityLogsEnum::APP_CLIENTE_AGENDOU_CONSULTA->description(),
                $info->getDescription()
            );
            return true;
        });
    }
}
