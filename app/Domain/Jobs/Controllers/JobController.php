<?php


namespace Domain\Jobs\Controllers;


use App\Domain\Jobs\Requests\JobRequest;
use Core\Controllers\AbsctractCrudController;
use Core\Requests\AbstractCrudRequest;
use Core\Services\AbstractCrudServiceInterface;
use Domain\Jobs\Models\Job;
use Domain\Jobs\Requests\JobSearchRequest;
use Domain\Jobs\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

final class JobController extends AbsctractCrudController
{
    public function getService(): AbstractCrudServiceInterface
    {
        return app(JobService::class);
    }

    public function search(JobSearchRequest $request): JsonResponse
    {
        $term = $request->validated();
        $term = Str::lower($term['term']);
        return Response::json(Job::search($term)->paginate(5));
    }

    public function getRequest(): AbstractCrudRequest
    {
        return app(JobRequest::class);
    }
}
