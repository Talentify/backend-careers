<?php

namespace App\Infrastructure\Action\Admin\Jobs;

use App\Domain\Model\Job;
use App\Domain\Service\JobServiceInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\{
    RedirectResponse,
    Response,
    Session\SessionInterface
};

class DeleteAction
{
    /**
     * @Route("/admin/jobs/{job}/delete", name="job_delete", methods={"GET"})
     */
    public function __invoke(
        RouterInterface $router,
        JobServiceInterface $jobService,
        SessionInterface $session,
        Job $job
    ): Response {
        $jobService->remove($job);
        $session->getFlashBag()->add('success', 'Job removed!');

        return new RedirectResponse(
            $router->generate('jobs_list')
        );
    }
}
