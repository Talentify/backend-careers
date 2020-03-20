<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Core\Http\Controllers\Controller;
use App\Http\Requests\V1\Position\PositionGetAll;
use App\Http\Requests\V1\Position\PositionStore;
use App\Http\Resources\V1\PositionResource;
use App\Http\Resources\V1\PositionResourceCollection;
use App\Services\V1\PositionService;
use Exception;

/**
 * Class PositionController
 *
 * @package App\Http\Controllers\V1
 */
class PositionController extends Controller
{
    private PositionService $positionService;

    /**
     * PositionController constructor.
     */
    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PositionGetAll $positionGetAll): PositionResourceCollection
    {
        return $this->positionService->getAll($positionGetAll);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(PositionStore $positionStore): PositionResource
    {
        return $this->positionService->store($positionStore);
    }
}
