<?php

namespace App\Infrastructure\Action\Admin\Jobs;

use App\Domain\Model\Job;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ConfirmeDeleteAction
{
    /**
     * @Route("/admin/jobs/{job}/confirme/delete", name="job_confirme_delete", methods={"GET"})
     */
    public function __invoke(
        Environment $environment,
        Job $job
    ): Response {
        return new Response(
            $environment->render(
                '/admin/jobs/confirme.delete.html.twig',
                [
                    'job' => $job,
                ]
            )
        );
    }
}
