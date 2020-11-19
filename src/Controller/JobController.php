<?php

namespace App\Controller;

use App\Entity\Job;
use App\Service\JobService;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class JobController
{
    /**
     * @var JobService
     */
    private JobService $jobService;

    /**
     * JobController constructor.
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return JsonResponse
     *
     * @Route(
     *     "/job",
     *     methods={"POST"},
     *     name="job-create"
     * )
     */
    public function create(Request $request, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $this->jobService->persist($serializer->deserialize($request->getContent(), Job::class, Job::class)),
            Response::HTTP_CREATED
        );
    }

    /**
     * @return JsonResponse
     * @throws NoResultException
     *
     * @Route(
     *     "/job",
     *     methods={"GET"},
     *     name="job-read"
     * )
     */
    public function read(): JsonResponse
    {
        return new JsonResponse($this->jobService->find([], null, null, null), Response::HTTP_OK);
    }
}