<?php


namespace Core\Controllers;


use App\Core\Requests\EmptyRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

abstract class AbsctractCrudController implements AbstractCrudControllerInterface
{
    /**
     * @param EmptyRequest $request
     * @return JsonResponse
     */
    public function getAll(EmptyRequest $request): JsonResponse
    {
        return Response::json($this->getService()->getAllPaginated());
    }

    /**
     * @param $id
     * @param EmptyRequest $request
     * @return JsonResponse
     */
    public function getOne($id, EmptyRequest $request): JsonResponse
    {
        $id = $this->getRequest()->validateID($id);
        return Response::json($this->getService()->getOne($id)->toArray());
    }

    /**
     * @param EmptyRequest $request
     * @return JsonResponse
     */
    public function saveOne(EmptyRequest $request): JsonResponse
    {
        $entity = $this->getRequest()->validateToDTO();
        return Response::json($this->getService()->saveOne($entity));
    }

    /**
     * @param $id
     * @param EmptyRequest $request
     * @return JsonResponse
     */
    public function updateOne($id, EmptyRequest $request): JsonResponse
    {
        $id = $this->getRequest()->validateID($id);
        $entity = $this->getRequest()->validateToDTO();
        return Response::json($this->getService()->updateOne($id, $entity));
    }

    /**
     * @param $id
     * @param EmptyRequest $request
     * @return JsonResponse
     */
    public function deleteOne($id, EmptyRequest $request): JsonResponse
    {
        $id = $this->getRequest()->validateID($id);
        return Response::json($this->getService()->deleteOne($id), 204);
    }
}
