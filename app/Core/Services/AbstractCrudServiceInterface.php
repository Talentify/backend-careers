<?php


namespace Core\Services;


use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModel;
use Core\Requests\AbstractCrudRequestInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AbstractCrudServiceInterface
{
    /**
     * Metodo criado porque PHP não oferece suporte à Generics
     * @return AbstractModel
     */
    public function getModel(): AbstractModel;

    public function getAll(): Collection;

    public function getAllPaginated(): LengthAwarePaginator;

    public function getOne($id): AbstractDTOInterface;

    public function saveOne(AbstractDTOInterface $dto): AbstractDTOInterface;

    public function updateOne($id, AbstractDTOInterface $dto): AbstractDTOInterface;

    public function deleteOne($id): bool;
}
