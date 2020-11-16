<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\VagaRepository;
use App\Resource\VagaResource;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VagaController extends AbstractController
{
    private VagaRepository $vagaRepository;

    /**
     * VagaController constructor.
     * @param VagaRepository $vagaRepository
     */
    public function __construct(VagaRepository $vagaRepository)
    {
        $this->vagaRepository = $vagaRepository;
    }


    /**
     * @Route("/", name="vagas")
     */
    public function index(): Response
    {
        $vagas = $this->vagaRepository->findAll();

        return $this->render('vaga/index.html.twig', [
            'controller_name' => 'VagaController',
            'vagas' => $vagas,
        ]);
    }

    /**
     * @Route("vaga/new", name="new")
     */
    public function new(): Response
    {
        return $this->render('vaga/new.html.twig');
    }

    /**
     * @Route("vaga/create", name="create", methods={"post"})
     * @param Request $request
     * @param VagaResource $vagaResource
     * @return Response
     */
    public function create(
        Request $request,
        VagaResource $vagaResource
    ): Response {
        try {
            $response = $vagaResource->create($request);
            if (is_object($response)) { //erros
                return $this->render('vaga/erro.html.twig', [
                    'erros' => $response,
                ]);
            }

            return $this->render('vaga/sucesso.html.twig', [
                'erros' => $response,
            ]);

        } catch (Exception $e) {
            return new Response((string) $e->getMessage());
        }
        return new Response('teste123');
    }
}
