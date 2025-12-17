<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ApplyFiltersPipeline
{
    /**
     * @param  Builder  $query
     * @param  array<int, array<string, mixed>>  $filters
     * @return Builder
     */
    public function run(Builder $query, array $filters): Builder
    {
        if (empty($filters)) {
            return $query;
        }

        $table = $query->getModel()->getTable();

        foreach ($filters as $filter) {
            // Valid the structure
            if (empty($filter['column']) || !array_key_exists('value', $filter)) {
                continue;
            }

            $column = $filter['column'];
            $value  = $filter['value'];

            // Deal with relationship filter (e.g., client.name)
            if (Str::contains($column, '.')) {
                [$relation, $relationColumn] = explode('.', $column, 2);

                $query->whereHas($relation, function (Builder $q) use ($relationColumn, $value) {
                    $q->where($relationColumn, 'like', "%{$value}%");
                });

                continue;
            }

            // It try to find a custom filter class (e.g., FilterByStatus)
            $filterClass = $this->resolveFilterClass($column);

            if (class_exists($filterClass)) {
                (new $filterClass())->apply($query, $value);
                continue;
            }

            // Default behavior (prefix with table to avoid ambiguity).
            $query->where("{$table}.{$column}", 'like', "%{$value}%");
        }

        return $query;
    }

    /**
     * It resolve the custom filter class name based on the column.
     * for example column: 'status' -> App\Filters\FilterByStatus
     */
    protected function resolveFilterClass(string $column): string
    {
        return 'App\\Filters\\FilterBy' . Str::studly($column);
    }
}