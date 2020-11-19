<?php

namespace App\Controller\Job;

use App\Service\JobService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListJobController extends AbstractController
{
    /**
     * @Route("/v1/jobs", name="job_list_job")
     */
    public function __invoke(JobService $jobService): Response
    {
        return $this->json($jobService->getActive());
    }
}
