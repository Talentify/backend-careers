<?php


namespace Core\Services;


use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class AbsctractCrudService implements AbstractCrudServiceInterface
{
    public function getAll(): Collection
    {
        return $this->getModel()::all();
    }

    public function getAllPaginated(): LengthAwarePaginator
    {
        return $this->getModel()->newQuery()->paginate(2);
    }

    public function getOne($id): AbstractDTOInterface
    {
        /**@var AbstractModel $entity */
        $entity = $this->getModel()->newQuery()->findOrFail($id);
        return $entity->toDto();
    }

    public function saveOne(AbstractDTOInterface $dto): AbstractDTOInterface
    {
        try {
            DB::beginTransaction();
            $entity = $this->getModel();
            DB::commit();
            return $this->saveAndReturnDTO($entity, $dto);
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    private function saveAndReturnDTO($entity, $dto)
    {
        $entity->fill($dto->toModelArray());
        $entity->saveOrFail();
        return $entity->toDto();
    }

    public function updateOne($id, AbstractDTOInterface $dto): AbstractDTOInterface
    {
        try {
            DB::beginTransaction();
            /**@var AbstractModel $entity */
            $entity = $this->getModel()->newQuery()->findOrFail($id);
            DB::commit();
            return $this->saveAndReturnDTO($entity, $dto);
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function deleteOne($id): bool
    {
        try {
            DB::beginTransaction();
            /**@var AbstractModel $entity */
            $entity = $this->getModel()->newQuery()->findOrFail($id);
            DB::commit();
            return $entity->delete();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
