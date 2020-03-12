<?php


namespace App\Controller\Admin;


use App\Entity\JobOpportunity;
use App\Form\JobOpportunityType;
use App\Services\JobOpportunity\JobOpportunityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOpportunityController extends AbstractController
{
    private JobOpportunityService $jobOpportunityService;

    public function __construct(JobOpportunityService $jobOpportunityService)
    {
        $this->jobOpportunityService = $jobOpportunityService;
    }

    /**
     * @Route("admin/job_oportunity", name="app_admin_job_opportunity_create")
     */
    public function create(Request $request): Response
    {
        $jobOpportunity = new JobOpportunity();

        $form = $this->createForm(JobOpportunityType::class, $jobOpportunity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobOpportunity = $form->getData();
            $this->jobOpportunityService->create($jobOpportunity);

            $this->addFlash(
                'success',
                'Job opportunity registered successfully.'
            );
        }

        return $this->render('admin/job_opportunity/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}