<?php

declare(strict_types=1);

namespace App\Services\Notes;

use App\Dtos\NoteDto;
use App\Enums\Logs\Note\SegmentNoteEnum;
use App\Facades\SaveNoteFacade;
use App\Models\Client\Client;
use App\Models\Common\Note;

class NoteCreateService
{
    public function createFinancialNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::FINANCIAL, $data);
    }

    public function createScheduleNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::SCHEDULE, $data);
    }

    public function createPrescriptionNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::PRESCRIPTION, $data);
    }

    public function createMedialRecordsNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::MEDICAL_RECORD, $data);
    }

    public function createExameNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::EXAME, $data);
    }

    public function createServiceNote(Client $client, array $data): Note
    {
        return $this->createNote($client, SegmentNoteEnum::SERVICE, $data);
    }

    private function createNote(Client $client, SegmentNoteEnum $segment, array $data): Note
    {
        data_set($data, 'client_id', $client->id);
        data_set($data, 'segment', $segment);

        $dto = NoteDto::createFromArray($data);
        $note = new Note;

        return SaveNoteFacade::save($note, $dto);
    }
}
