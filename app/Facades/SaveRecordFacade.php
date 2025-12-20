<?php

namespace App\Facades;

use App\Logic\Contracts\SaveRecordContract;
use Illuminate\Support\Facades\Facade;

class SaveRecordFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return SaveRecordContract::class;
    }
}