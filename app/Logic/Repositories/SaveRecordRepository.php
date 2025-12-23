<?php

namespace App\Logic\Repositories;

use App\Logic\Contracts\SaveRecordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SaveRecordRepository implements SaveRecordContract
{
    /**
     * Save attributes to the given model inside a transaction and return the
     * fresh instance. Throws RuntimeException on failure.
     *
     * @param Model|null $model
     * @param array $data
     * @return Model
     */
    public function save(?Model $model, array $data): Model
    {
        if (!$model instanceof Model) {
            throw new ModelNotFoundException(
                'Erro ao tentar salvar modelo! Recarregue e tente novamente'
            );
        }

        try {
            return DB::transaction(function () use ($model, $data) {
                $model->fill($data);

                if (!$model->save()) {
                    throw new RuntimeException('Não foi possível persistir o modelo.');
                }

                return $model->refresh();
            });
        } catch (\Throwable $e) {
            throw new RuntimeException(
                sprintf(
                    'Falha ao salvar %s: %s',
                    $model::class,
                    $e->getMessage()
                ),
                $e->getCode() ?? 0,
                $e
            );
        }
    }
}