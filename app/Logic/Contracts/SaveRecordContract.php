<?php

declare(strict_types=1);

namespace App\Logic\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SaveRecordContract
{
    public function save(Model $model, array $data): Model;
}