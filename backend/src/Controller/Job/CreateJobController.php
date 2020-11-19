<?php

namespace App\Controller\Job;

use App\Service\JobService;
use App\Validator\CreateJobValidator;
use App\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateJobController extends AbstractController
{
    protected $validator;

    public function __construct(CreateJobValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @Route("/v1/jobs", name="job_create_job", methods={"POST"})
     */
    public function __invoke(Request $request, JobService $jobService): Response
    {
        $data = $request->request->all();

        $errors = $this->validator->__invoke($data);
        if (count($errors) !== 0) {
            throw new ValidationException($errors);
        }

        $job = $jobService->create($data);
        return $this->json($job);
    }
}
