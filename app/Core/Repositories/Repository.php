<?php

declare(strict_types=1);

namespace App\Core\Repositories;

use App\Core\Models\Model;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Repository
 *
 * @package App\Core\Repositories
 */
abstract class Repository
{
    protected Model $model;
    protected Builder $query;

    abstract protected function model(): string;

    abstract protected function filters($filter, $value): Builder;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->model());
        $this->query = $this->model->newQuery();
    }

    /**
     * @param  array  $options
     *
     * @return LengthAwarePaginator
     */
    public function getAll(array $options): LengthAwarePaginator
    {
        $filters = $options['filters'] ?? [];
        $orderBy = $options['order_by'] ?? 'id';
        $direction = $options['direction'] ?? 'desc';
        $perPage = $options['per_page'] ?? 15;

        return $this
            ->applyFilters($filters)
            ->orderBy($orderBy, $direction)
            ->paginate($perPage);
    }

    public function count(array $options): int
    {
        $filters = $options['filters'] ?? [];

        return $this
            ->applyFilters($filters)
            ->count();
    }

    /**
     * @param  array  $data
     *
     * @return Model
     * @throws Exception
     */
    public function store(array $data): Model
    {
        $saveResult = $this->model->fill($data)->save();

        if (! $saveResult) {
            throw new Exception('Could not store registry');
        }

        return $this->model;
    }

    /**
     * @param  int  $id
     *
     * @return Model
     */
    public function get(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Model
     * @throws Exception
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->get($id);

        $updateResult = $model->update($data);

        if (! $updateResult) {
            throw new Exception('Could not update registry');
        }

        return $model;
    }

    /**
     * @param  int  $id
     *
     * @return bool
     * @throws Exception
     */
    public function destroy(int $id): bool
    {
        $model = $this->get($id);

        $destroyResult = $model->delete();

        if (! $destroyResult) {
            throw new Exception('Could not delete registry');
        }

        return true;
    }

    protected function applyFilters($filters): Builder
    {
        foreach ($filters as $filter => $value) {
            $this->filters($filter, $value);
        }

        return $this->query;
    }
}