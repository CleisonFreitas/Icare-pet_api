<?php

namespace App\Facades;

use App\Logic\Contracts\SaveNoteContract;
use Illuminate\Support\Facades\Facade;

class SaveNoteFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return SaveNoteContract::class;
    }
}