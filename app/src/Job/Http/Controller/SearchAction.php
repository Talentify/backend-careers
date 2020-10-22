<?php

namespace App\Job\Http\Controller;

use App\Job\Service\JobService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Exception;

/**
 * Class SearchAction
 * @package App\Job\Http\Controller
 */
class SearchAction
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
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data = [];
        parse_str($request->getQueryString(), $data);

        try {
            $data = $this->jobService->findBy($data);
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
