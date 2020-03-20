<?php

declare(strict_types=1);

namespace App\Services\V1;

use App\Core\Services\Service;
use App\Http\Requests\V1\Position\PositionGetAll;
use App\Http\Requests\V1\Position\PositionStore;
use App\Http\Resources\V1\PositionResource;
use App\Http\Resources\V1\PositionResourceCollection;
use App\Repositories\V1\PositionRepository;
use Exception;

/**
 * Class PositionService
 *
 * @package App\Services\V1\Auth
 */
class PositionService extends Service
{
    private PositionRepository $positionRepository;

    /**
     * PositionService constructor.
     *
     * @param  PositionRepository  $positionRepository
     */
    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function getAll(PositionGetAll $positionGetAll): PositionResourceCollection
    {
        $all = $this->positionRepository->getAll($positionGetAll->validated());

        return new PositionResourceCollection($all);
    }

    /**
     * @throws Exception
     */
    public function store(PositionStore $positionStore): PositionResource
    {
        $position = $this->positionRepository->store($positionStore->validated());

        return new PositionResource($position);
    }
}
