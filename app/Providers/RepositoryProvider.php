<?php

namespace App\Providers;

use App\Logic\Contracts\SaveRecordContract;
use App\Logic\Repositories\SaveRecordRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SaveRecordContract::class, SaveRecordRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
