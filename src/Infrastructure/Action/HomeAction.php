<?php

namespace App\Infrastructure\Action;

use App\Domain\Enum\Job\StatusEnum;
use App\Domain\Service\JobServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeAction
{

    /**
     * @Route(name="home", path="/", methods={"GET"})
     * @Route(name="home_page", path="/page/{page}", methods={"GET"})
     */
    public function __invoke(Environment $twig, JobServiceInterface $jobService, ?int $page = null)
    {
        $list = $jobService->findAllActives();


        return new Response(
            $twig->render('/home.html.twig', [
                'data' => $jobService->findInPaginator($page ?? 1, StatusEnum::OPEN),
            ])
        );
    }
}