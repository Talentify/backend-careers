<?php


namespace App\Services;


use App\Repositories\Contracts\RecruiterRepositoryInterface;

class RecruiterService
{
    private $recruiterRepository;

    public function __construct(RecruiterRepositoryInterface $recruiterRepository)
    {
        $this->recruiterRepository = $recruiterRepository;
    }

    public function index(int $per_page)
    {
        return $this->recruiterRepository->orderBy('name', 'ASC')->relationships('company')->paginate($per_page);
    }

    public function show($id)
    {
        return $this->recruiterRepository->findWhereFirst("id", $id);
    }

    public function store($request)
    {
        $recruiter = $this->recruiterRepository->store($request->all());

        if (!$recruiter)
            return false;

        return true;
    }

    public function update($id, $request)
    {
        if(!isset($request['name'])){
            return false;
        }

        return $this->recruiterRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->recruiterRepository->delete($id);
    }

}
