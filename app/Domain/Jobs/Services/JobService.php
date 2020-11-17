<?php


namespace Domain\Jobs\Services;


use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModel;
use Core\Services\AbsctractCrudService;
use Domain\Jobs\DTOs\JobDTO;
use Domain\Jobs\Models\Address;
use Domain\Jobs\Models\Job;
use Illuminate\Support\Facades\DB;

final class JobService extends AbsctractCrudService
{

    public function getModel(): AbstractModel
    {
        return app(Job::class);
    }

    /**
     * @param AbstractDTOInterface|JobDTO $dto
     * @return AbstractDTOInterface
     */
    public function saveOne(AbstractDTOInterface $dto): AbstractDTOInterface
    {
        try {
            DB::beginTransaction();
            $entity = $this->getModel();
            $entity->fill($dto->toModelArray());
            $entity->saveOrFail();
            /**@var Job|AbstractModel $entity */
            $entity->address()->associate(Address::create($dto->address->toModelArray()));
            $entity->save();
            $dto = $entity->refresh()->toDTO();
            DB::commit();
            return $dto;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function updateOne($id, AbstractDTOInterface $dto): AbstractDTOInterface
    {
        try {
            DB::beginTransaction();
            /**@var AbstractModel $entity */
            $entity = $this->getModel()->newQuery()->findOrFail($id);
            $entity->fill($dto->toModelArray());
            $entity->saveOrFail();
            /**@var Job|AbstractModel $entity */
            $entity->address->update($dto->address->toModelArray());
            $entity->save();
            $dto = $entity->refresh()->toDTO();
            DB::commit();
            return $dto;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
