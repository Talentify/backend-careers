<?php

namespace App\Infrastructure\Action\Admin\Jobs;

use App\Domain\Model\Job;
use App\Domain\Service\JobServiceInterface;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;
use App\Infrastructure\Form\Type\JobType;
use App\Infrastructure\Service\Validator\JobValidatorService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\{RedirectResponse, Request, Response, Session\SessionInterface};

class FormAction
{
    /**
     * @Route("/admin/jobs/new", name="job_new", methods={"GET", "POST"})
     * @Route("/admin/jobs/{job}/edit", name="job_edit", methods={"GET", "POST"})
     */
    public function __invoke(
        Request $request,
        Environment $environment,
        JobServiceInterface $jobService,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        SessionInterface $session,
        ?Job $job = null
    ): Response {
        $form = $formFactory->create(JobType::class, $job);
        $form->handleRequest($request);

        if ($request->isMethod('post') && $form->isSubmitted() && $form->isValid()) {
            $errors = (new JobValidatorService())->validate($form->getData());

            if ($errors->count()) {
                $errors->map(function ($error) use($session) {
                    $session->getFlashBag()->add('danger', $error);
                });

                return new RedirectResponse(
                    $router->generate('jobs_list')
                );
            }

            $jobService->save($form->getData());

            $session->getFlashBag()->add('success', 'Job saved!');

            return new RedirectResponse(
                $router->generate('jobs_list')
            );
        }

        return new Response(
            $environment->render(
                '/admin/jobs/new.html.twig',
                [
                    'formJob' => $form->createView(),
                ]
            )
        );
    }
}
