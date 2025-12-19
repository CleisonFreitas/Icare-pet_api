<?php

namespace Database\Factories\Common;

use App\Enums\Logs\Note\SegmentNoteEnum;
use App\Models\Client\Client;
use App\Models\Common\Note;
use App\Models\Pet\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'content' => $this->faker->text,
            'user_id' => User::factory()->lazy(),
            'client_id' => Client::factory()->lazy(),
            'pet_id' => Pet::factory()->lazy(),
            'segment' => $this->faker->randomElement(SegmentNoteEnum::cases())
        ];
    }
}
