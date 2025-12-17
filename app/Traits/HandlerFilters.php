<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait HandlerFilters
{
    /**
     * List of allowed filters for this controller.
     *
     * @var array<int, string>
     */
    protected array $allowedFilters = [];

    /**
     * Set allowed filters.
     */
    protected function setAllowedFilters(array $filters): void
    {
        $this->allowedFilters = $filters;
    }

    /**
     * Validate and extract filters from the request.
     *
     * @throws ValidationException
     */
    protected function extractFiltersFrom(Request $request): array
    {
        $filters = $request->input('filters', []);

        if (!is_array($filters)) {
            throw ValidationException::withMessages([
                'filters' => ['Filters must be an array.'],
            ]);
        }

        foreach ($filters as $filter) {
            if (empty($filter['column'])) {
                throw ValidationException::withMessages([
                    'filters' => ['cada filtro deve possuir um campo coluna.'],
                ]);
            }

            $column = $filter['column'];

            // Validate against predefined filters
            if (!in_array($column, $this->allowedFilters, true)) {
                throw ValidationException::withMessages([
                    'filters' => ["O filtro '{$column}' não está habilitado."],
                ]);
            }
        }

        return $filters;
    }

    /**
     * Validate and extract orders from the request.
     */
    protected function extractOrdersFrom(Request $request): array
    {
        $orders = $request->input('orders', []);

        if (!is_array($orders)) {
            throw ValidationException::withMessages([
                'ordernacoes' => ['ordenações precisa ser um array.'],
            ]);
        }

        foreach ($orders as $order) {
            if (empty($order['column'])) {
                throw ValidationException::withMessages([
                    'ordem' => ['Cada ordem deve ter um campo coluna.'],
                ]);
            }

            $column = $order['column'];

            if (!in_array($column, $this->allowedFilters, true)) {
                throw ValidationException::withMessages([
                    'ordem' => ["A coluna de ordem '{$column}' não é permitida."],
                ]);
            }
        }

        return $orders;
    }

    /**
     * Validate the structure of the submitted search text.
     * @param Request $request
     * @return string
     */
    protected function sanitizeSearch(Request $request): string
    {
        $search = $request->input('pesquisa');
        if (is_null($search) || $search === '') {
            return '';
        }

        if (!is_string($search)) {
            throw ValidationException::withMessages([
                'pesquisa' => ['Insira um texto válido no campo pesquisa.'],
            ]);
        }

        return $search;
    }
}
