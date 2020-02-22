<?php

declare(strict_types=1);

namespace App\Core\Http\Requests;

use Illuminate\Validation\Rule;

abstract class GetAllRequest extends Request
{
    abstract function allowedOrderBy(): array;

    abstract function allowedFilters(): array;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'limit'     => ['integer', 'max:100'],
            'per_page'  => ['integer'],
            'sort'      => [
                'string',
                Rule::in($this->allowedOrderBy()),
            ],
            'direction' => [
                'string',
                Rule::in([
                    'asc',
                    'desc',
                ]),
            ],
        ], $this->getFilters());
    }

    public function getFilters(): array
    {
        $allowedFilters = $this->allowedFilters();
        $filters = [];

        foreach ($allowedFilters as $key => $filter) {
            if (is_array($filter)) {
                $filters['filter.'.$key] = $filter;
            } else {
                $filters['filter.'.$filter] = [];
            }
        }

        return $filters;
    }
}
