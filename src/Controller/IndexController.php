<?php

namespace App\Controller;

use App\Services\JobOpportunity\JobOpportunityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private JobOpportunityService $jobOpportunityService;

    public function __construct(JobOpportunityService $jobOpportunityService)
    {
        $this->jobOpportunityService = $jobOpportunityService;
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index() :Response
    {
        $jobOpportunities = $this->jobOpportunityService->findAll();

        return $this->render('index/index.html.twig', [
            'job_opportunities' => $jobOpportunities
        ]);
    }
}