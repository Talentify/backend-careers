<?php

namespace App\Job\Http\Controller;

use App\Job\Service\JobService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Exception;

/**
 * Class SearchUniqueAction
 * @package App\Job\Http\Controller
 */
class SearchUniqueAction
{
    /**
     * @var JobService
     */
    private $jobService;

    /**
     * CreateAction constructor.
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request)
    {
        try {
            $data = $this->jobService->find($id);
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST);
        } catch (Throwable $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'data' => $data,
            'status' => 'ok'
        ], Response::HTTP_OK);
    }
}
