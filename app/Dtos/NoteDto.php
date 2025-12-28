<?php

declare(strict_types=1);

namespace App\Dtos;

use App\Enums\Logs\Note\SegmentNoteEnum;

class NoteDto
{
    public function __construct(
        private readonly string $title,
        private readonly string $content,
        private readonly ?int $user_id = null,
        private readonly ?int $client_id = null,
        private readonly int $pet_id,
        private readonly SegmentNoteEnum $segment,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    public function getPetId(): ?int
    {
        return $this->pet_id;
    }

    public function getSegment(): SegmentNoteEnum
    {
        return $this->segment;
    }

    public static function createFromArray(array $data): NoteDto
    {
        $keysMapped = [
            'title',
            'content',
            'user_id',
            'client_id',
            'pet_id',
            'segment'
        ];

        $divergentKeys = array_diff(array_keys($data), $keysMapped);
        
        if (!empty($divergentKeys)) {
            throw new \Exception(
                'Os campos: ('. implode(", ", $divergentKeys) . ') não são permitidos'
            );
        }

        return new NoteDto(
            title: data_get($data, 'title'),
            content: data_get($data, 'content'),
            user_id: data_get($data, 'user_id'),
            client_id: data_get($data, 'client_id'),
            pet_id: data_get($data, 'pet_id'),
            segment: data_get($data, 'segment')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}