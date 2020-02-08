<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Core\Http\Controllers\Controller;
use App\Http\Requests\V1\ExampleDestroy;
use App\Http\Requests\V1\ExampleGet;
use App\Http\Requests\V1\ExampleGetAll;
use App\Http\Requests\V1\ExampleStore;
use App\Http\Requests\V1\ExampleUpdate;
use App\Http\Resources\V1\ExampleResource;
use App\Http\Resources\V1\ExampleResourceCollection;
use App\Services\V1\Auth\ExampleService;
use Exception;

/**
 * Class ExampleController
 *
 * @package App\Http\Controllers\V1
 */
class ExampleController extends Controller
{
    private ExampleService $exampleService;

    /**
     * ExampleController constructor.
     *
     * @param  ExampleService  $exampleService
     */
    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  ExampleGetAll  $exampleGetAll
     *
     * @return ExampleResourceCollection
     */
    public function index(ExampleGetAll $exampleGetAll)
    {
        return $this->exampleService->getAll($exampleGetAll);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExampleStore  $exampleStore
     *
     * @return ExampleResource
     * @throws Exception
     */
    public function store(ExampleStore $exampleStore)
    {
        return $this->exampleService->store($exampleStore);
    }

    /**
     * Display the specified resource.
     *
     * @param  ExampleGet  $exampleGet
     * @param  int         $id
     *
     * @return ExampleResource
     */
    public function show(ExampleGet $exampleGet, int $id)
    {
        return $this->exampleService->get($id, $exampleGet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExampleUpdate  $exampleUpdate
     * @param  int            $id
     *
     * @return ExampleResource
     * @throws Exception
     */
    public function update(ExampleUpdate $exampleUpdate, int $id)
    {
        return $this->exampleService->update($id, $exampleUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ExampleDestroy  $exampleDestroy
     * @param  int             $id
     *
     * @return int
     * @throws Exception
     */
    public function destroy(ExampleDestroy $exampleDestroy, int $id)
    {
        $result = $this->exampleService->destroy($id, $exampleDestroy);

        return response()->success($result);
    }
}
