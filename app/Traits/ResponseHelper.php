<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseHelper
{
    /**
     * @param null $data
     * @param int $status
     * @return JsonResponse
     */
    public function createApiResponse($data = null, $status = Response::HTTP_OK): JsonResponse
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }
        return response()->json($data, $status);
    }

    /**
     * Returns json response for generic bad request.
     * @param string|null $message
     * @return JsonResponse
     */
    protected function badRequest(string $message = null): JsonResponse
    {
        return $this->createApiResponse(['errors' => [$message]], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Returns json response for a page not found
     * @param string|null $message
     * @return JsonResponse
     */
    protected function notFound(string $message = null): JsonResponse
    {
        return $this->createApiResponse(['errors' => [$message]], Response::HTTP_NOT_FOUND);
    }

    /**
     * Returns json response for a successful request
     * but no contains response content
     * @param string|null $message
     * @return JsonResponse
     */
    protected function okButNoContent(string $message = null): JsonResponse
    {
        return $this->createApiResponse($message, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function createApiResponseErrors(array $data, int $status): JsonResponse
    {
        $messages = [
            'message' => 'The given data was invalid.',
            'errors' => $data
        ];

        return $this->createApiResponse($messages, $status);
    }

    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function createApiResponseError(string $data, int $status): JsonResponse
    {
        return $this->createApiResponse($data, $status);
    }
}
