<?php

namespace App\Providers;

use App\Logic\Contracts\SaveNoteContract;
use App\Logic\Contracts\SaveRecordContract;
use App\Logic\Repositories\SaveNoteRepository;
use App\Logic\Repositories\SaveRecordRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SaveRecordContract::class, SaveRecordRepository::class);
        $this->app->bind(SaveNoteContract::class, SaveNoteRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
