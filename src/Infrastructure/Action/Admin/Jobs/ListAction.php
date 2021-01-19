<?php

namespace App\Infrastructure\Action\Admin\Jobs;

use App\Domain\Service\JobServiceInterface;
use App\Infrastructure\Form\Type\SearchType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\{
    Request, Response
};

class ListAction
{
    /**
     * @Route("/admin/jobs", name="jobs_list", methods={"GET"})
     * @Route("/admin/jobs/page/{page}", name="jobs_list_page", methods={"GET"})
     * @Route("/admin/jobs/status/{status}", name="jobs_list_status", methods={"GET"})
     * @Route("/admin/jobs/status/{status}/page/{page}", name="jobs_list_status_page", methods={"GET"})
     */
    public function __invoke(
        Request $request,
        Environment $environment,
        JobServiceInterface $jobService,
        FormFactoryInterface $formFactory,
        int $status = null,
        int $page = null
    ): Response {
        $form = $formFactory->create(SearchType::class, ['status' => $status]);

        return new Response(
            $environment->render(
                '/admin/jobs/list.html.twig',
                [
                    'data' => $jobService->findInPaginator($page ?? 1, $status),
                    'search' => $form->createView(),
                ]
            )
        );
    }
}
