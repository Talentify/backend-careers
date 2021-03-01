<?php

namespace App\Http\Controllers;

use App\Adapters\LogMonologAdapter;
use App\Http\Requests\Jobs\Create\Request as HttpRequest;
use App\Http\Requests\Jobs\Search\Request;
use App\Repositories\JobRepository;
use Recruitment\Modules\Jobs\Create\Entities\Address as CreateAddress;
use Recruitment\Modules\Jobs\Create\Entities\Job as CreateJob;
use Recruitment\Modules\Jobs\Create\Requests\Request as CreateRequest;
use Recruitment\Modules\Jobs\Create\UseCase as CreateUseCase;
use Recruitment\Modules\Jobs\Delete\Requests\Request as DeleteRequest;
use Recruitment\Modules\Jobs\Delete\UseCase as DeleteUseCase;
use Recruitment\Modules\Jobs\Get\UseCase;
use Recruitment\Modules\Jobs\Show\Requests\Request as ShowRequest;
use Recruitment\Modules\Jobs\Show\UseCase as ShowUseCase;
use Recruitment\Modules\Jobs\Update\Entities\Address as UpdateAddress;
use Recruitment\Modules\Jobs\Update\Entities\Job as UpdateJob;
use Recruitment\Modules\Jobs\Update\Requests\Request as UpdateRequest;
use Recruitment\Modules\Jobs\Update\UseCase as UpdateUseCase;
use Recruitment\Modules\Jobs\Search\UseCase as SearchUseCase;
use Recruitment\Modules\Jobs\Search\Requests\Request as SearchRequest;


class JobController extends Controller
{
    public function store(HttpRequest $httpRequest)
    {
        $address = $httpRequest->get('address');
        $request = new CreateRequest(
            new CreateJob(
                $httpRequest->get('tittle'),
                $httpRequest->get('description'),
                $httpRequest->get('status'),
                new CreateAddress(
                    $address['address'],
                    $address['number'],
                    $address['city'],
                    $address['state'],
                    $address['country'],
                    $address['complement']
                ),
                $httpRequest->get('salary'),
                $httpRequest->get('keywords'),
                $httpRequest->get('recruiterId')
            )
        );

        $useCase = new CreateUseCase(
            new JobRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function update(HttpRequest $httpRequest, int $id)
    {
        $address = $httpRequest->get('address');
        $request = new UpdateRequest(
            new UpdateJob(
                $id,
                $httpRequest->get('tittle'),
                $httpRequest->get('description'),
                $httpRequest->get('status'),
                new UpdateAddress(
                    $address['address'],
                    $address['number'],
                    $address['city'],
                    $address['state'],
                    $address['country'],
                    $address['complement']
                ),
                $httpRequest->get('salary'),
                $httpRequest->get('keywords'),
                $httpRequest->get('recruiterId')
            )
        );

        $jobRepository = new JobRepository();
        $useCase = new UpdateUseCase(
            $jobRepository,
            $jobRepository,
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function destroy(int $id)
    {
        $request = new DeleteRequest($id);

        $useCase = new DeleteUseCase(
            new JobRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function show(int $id)
    {
        $request = new ShowRequest($id);

        $useCase = new ShowUseCase(
            new JobRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function index()
    {
        $useCase = new UseCase(
            new JobRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute();

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }

    public function search(Request $httpRequest)
    {
        $request = new SearchRequest(
            $httpRequest->get('keywords'),
            $httpRequest->get('addressCity'),
            $httpRequest->get('addressState'),
            $httpRequest->get('addressCountry'),
            $httpRequest->get('salaryStart'),
            $httpRequest->get('salaryEnd'),
            $httpRequest->get('company')
        );

        $useCase = new SearchUseCase(
            new JobRepository(),
            new LogMonologAdapter()
        );

        $useCase->execute($request);

        return response()->json(
            $useCase->getResponse()->getPresenter()->toArray(),
            $useCase->getResponse()->getStatus()->getCode()
        );
    }
}
