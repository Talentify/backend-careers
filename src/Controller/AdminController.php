<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\VagaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private VagaRepository $vagaRepository;

    /**
     * AdminController constructor.
     * @param VagaRepository $vagaRepository
     */
    public function __construct(VagaRepository $vagaRepository)
    {
        $this->vagaRepository = $vagaRepository;
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $vagas = $this->vagaRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'vagas' => $vagas,
        ]);
    }
}
