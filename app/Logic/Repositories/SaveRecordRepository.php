<?php

namespace App\Logic\Repositories;

use App\Logic\Contracts\SaveRecordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SaveRecordRepository implements SaveRecordContract
{
    public function save(Model $model, array $data): Model
    {
        try {
            $model->fill($data);
            $model->save();
            return $model;
        } catch (ModelNotFoundException) {
            throw new ModelNotFoundException('Modelo informado não encontrado');
        }
    }
}
