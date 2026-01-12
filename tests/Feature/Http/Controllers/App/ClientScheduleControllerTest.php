<?php

namespace Tests\Feature\Http\Controllers\App;

use App\Enums\Logs\App\ClientActivityLogsEnum;
use App\Enums\Pets\StatusScheduleEnum;
use App\Events\App\ClientScheduleCancelled;
use App\Events\App\ClientScheduleUpdated;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;
use App\Models\Pet\Specie;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClientScheduleControllerTest extends TestCase
{
    #[Test]
    public function schedule(): void
    {
        Event::fake();
        $client = $this->actionAsClient();
        $pet = Pet::factory()->for($client)->create([
            'specie_id' => Specie::factory()->create()->id
        ]);
        $schedule = Schedule::factory()->create([
            'client_id' => null,
            'pet_id' => null,
            'status' => StatusScheduleEnum::OPEN
        ]);
        $uri = 'api/v1/app/client/%s/pet/%s/schedule';
        $api = sprintf($uri, $client->getKey(), $pet->getKey());
        $response = $this->put($api, [
            'schedule_id' => $schedule->id,
            'note' => [
                'title' => $this->faker->word,
                'content' => $this->faker->sentence
            ]
        ]);
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'client_id',
            'pet_id',
            'service_type'
        ]);

        Event::assertDispatched(ClientScheduleUpdated::class, function (ClientScheduleUpdated $event) {
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

    #[Test]
    public function cancel(): void
    {
        Event::fake();
        $client = $this->actionAsClient();
        $pet = Pet::factory()->for($client)->create([
            'specie_id' => Specie::factory()->create()->id
        ]);
        $schedule = Schedule::factory()
            ->for($client)
            ->for($pet)
            ->create([
                'status' => StatusScheduleEnum::OPEN
            ]);
        $uri = 'api/v1/app/client/%s/schedule/%s/cancel';
        $api = sprintf($uri, $client->getKey(), $schedule->getKey());

        $response = $this->putJson($api);
        $response->assertOk();

        Event::assertDispatched(
            ClientScheduleCancelled::class,
            function (ClientScheduleCancelled $event) {
                $info = $event->info;
                $this->assertEquals(
                    ClientActivityLogsEnum::APP_CLIENTE_CANCELOU_CONSULTA->value,
                    $info->getLogName()
                );
                $this->assertEquals(
                    ClientActivityLogsEnum::APP_CLIENTE_CANCELOU_CONSULTA->description(),
                    $info->getDescription()
                );
                return true;
            }
        );
    }
}
