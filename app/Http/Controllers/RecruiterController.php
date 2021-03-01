<?php

namespace App\Http\Controllers;

use App\Adapters\LogMonologAdapter;
use App\Http\Requests\Recruiters\Create\Request as HttpCreateRequest;
use App\Http\Requests\Recruiters\Login\Request;
use App\Repositories\RecruiterRepository;
use Recruitment\Modules\Recruiters\Create\Requests\Request as CreateRequest;
use Recruitment\Modules\Recruiters\Create\UseCase;

class RecruiterController extends Controller
{
    public function store(HttpCreateRequest $httpRequest)
    {
        $request = new CreateRequest(
            $httpRequest->get('name'),
            $httpRequest->get('cpf'),
            $httpRequest->get('companyId'),
            $httpRequest->get('email'),
            $httpRequest->get('password')
        );

        $useCase = new UseCase(
            new RecruiterRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function login(Request $httpRequest)
    {
        $request = new \Recruitment\Modules\Recruiters\Login\Requests\Request(
            $httpRequest->get('email'),
            $httpRequest->get('password')
        );

        $recruiterRepository = new RecruiterRepository();
        $useCase = new \Recruitment\Modules\Recruiters\Login\UseCase(
            $recruiterRepository,
            $recruiterRepository,
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }
}
