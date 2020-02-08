<?php

declare(strict_types=1);

namespace App\Services\V1\Auth;

use App\Core\Services\Service;
use App\Http\Requests\V1\ExampleDestroy;
use App\Http\Requests\V1\ExampleGet;
use App\Http\Requests\V1\ExampleGetAll;
use App\Http\Requests\V1\ExampleStore;
use App\Http\Requests\V1\ExampleUpdate;
use App\Http\Resources\V1\ExampleResource;
use App\Http\Resources\V1\ExampleResourceCollection;
use App\Repositories\V1\ExampleRepository;
use Exception;

/**
 * Class ExampleService
 *
 * @package App\Services\V1\Auth
 */
class ExampleService extends Service
{
    private ExampleRepository $exampleRepository;

    /**
     * ExampleService constructor.
     *
     * @param  ExampleRepository  $exampleRepository
     */
    public function __construct(ExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    /**
     * @param  ExampleGetAll  $exampleGetAll
     *
     * @return ExampleResourceCollection
     */
    public function getAll(ExampleGetAll $exampleGetAll): ExampleResourceCollection
    {
        $all = $this->exampleRepository->getAll($exampleGetAll->validated());

        return new ExampleResourceCollection($all);
    }

    /**
     * @param  ExampleStore  $exampleStore
     *
     * @return ExampleResource
     * @throws Exception
     */
    public function store(ExampleStore $exampleStore): ExampleResource
    {
        $example = $this->exampleRepository->store($exampleStore->validated());

        return new ExampleResource($example);
    }

    /**
     * @param  int         $id
     * @param  ExampleGet  $exampleGet
     *
     * @return ExampleResource
     */
    public function get(int $id, ExampleGet $exampleGet): ExampleResource
    {
        $example = $this->exampleRepository->get($id);

        return new ExampleResource($example);
    }

    /**
     * @param  int            $id
     * @param  ExampleUpdate  $exampleUpdate
     *
     * @return ExampleResource
     * @throws Exception
     */
    public function update(int $id, ExampleUpdate $exampleUpdate): ExampleResource
    {
        $example = $this->exampleRepository->update($id, $exampleUpdate->validated());

        return new ExampleResource($example);
    }

    /**
     * @param  int             $id
     * @param  ExampleDestroy  $exampleDestroy
     *
     * @return bool
     * @throws Exception
     */
    public function destroy(int $id, ExampleDestroy $exampleDestroy): bool
    {
        return $this->exampleRepository->destroy($id);
    }
}
