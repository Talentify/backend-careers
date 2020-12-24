<?php

namespace App\Infra\Controllers;

use App\Domain\Exception\FormValidationException;
use App\Application\JobOpeningCommand;
use App\Domain\JobOpening\DTO\JobOpening;
use App\Infra\Form\JobOpeningFormType;
use App\Infra\Request\JobOpeningRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JobOpeningController extends AbstractController
{
    /**
     * @Route("/admin/jobs", name="jobopening-create", methods={"POST"})
     */
    public function create(Request $request, JobOpeningCommand $action)
    {
        $data = json_decode($request->getContent(), true);

        $jobOpeningRequest = new JobOpeningRequest();
        $form = $this->createForm(JobOpeningFormType::class, $jobOpeningRequest);
        $form->submit($data);

        if (!$form->isValid()) {
           throw new FormValidationException((string) $form->getErrors(true, false));
        }

        $action->createJobOpening(JobOpening::fromRequest($jobOpeningRequest));

        return new JsonResponse([], Response::HTTP_CREATED);
    }

    /**
     * @Route("/jobs", name="jobopening-list", methods={"GET"})
     */
    public function list(Request $request, JobOpeningCommand $action)
    {
        $jobs = $action->listJobOpenings();
        return new JsonResponse($jobs, Response::HTTP_OK);
    }

}