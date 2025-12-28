<?php

declare(strict_types=1);

namespace App\Logic\Contracts;

use App\Dtos\NoteDto;
use App\Models\Common\Note;

interface SaveNoteContract
{
    /**
     * It will be responsible for creating multiples notes
     * related to the huge segments
     * @param Note $note
     * @param NoteDto $dto
     * 
     * @return Note
     */
    public function save(Note $note, NoteDto $dto): Note;
}