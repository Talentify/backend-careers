<?php


namespace Core\Controllers;


use App\Core\Requests\EmptyRequest;
use Core\Requests\AbstractCrudRequest;
use Core\Services\AbstractCrudServiceInterface;
use Illuminate\Http\JsonResponse;

/**
 * Como estamos trabalhando apenas no contexto de API todos os metodos são relativos à este contexto
 *
 * Interface AbstractCrudControllerInterface
 * @package Infrastructure\Http\Controllers
 */
interface AbstractCrudControllerInterface
{
    /**
     * Metodo criado porque PHP não oferece suporte à Generics
     * @return AbstractCrudServiceInterface
     */
    public function getService(): AbstractCrudServiceInterface;

    public function getRequest(): AbstractCrudRequest;

    public function getAll(EmptyRequest $request): JsonResponse;

    public function getOne($id, EmptyRequest $request): JsonResponse;

    public function saveOne(EmptyRequest $request): JsonResponse;

    public function updateOne($id, EmptyRequest $request): JsonResponse;

    public function deleteOne($id, EmptyRequest $request): JsonResponse;

//    public function updateMany(): JsonResponse;//todo

//    public function saveMany(): JsonResponse;//todo

//    public function deleteMany(): JsonResponse;//todo
}
