<?php

namespace App\Logic\Repositories;

use App\Dtos\NoteDto;
use App\Logic\Contracts\SaveNoteContract;
use App\Models\Common\Note;
use Illuminate\Support\Facades\Log;
use Throwable;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class SaveNoteRepository implements SaveNoteContract
{
    public function save(Note $note, NoteDto $dto): Note
    {
        try {
            $note->fill($dto->toArray());

            if (!$note->save()) {
                throw new RuntimeException('Não foi possível salvar a observação.');
            }

            return $note->refresh();
        } catch (Throwable $ex) {
            Log::error($ex->getMessage());
            throw new RuntimeException(
                'Falha ao tentar salvar observação',
                Response::HTTP_BAD_REQUEST,
                $ex
            );
        }
    }
}
