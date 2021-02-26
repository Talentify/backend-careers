<?php

namespace App\Repositores\Elloquent;

use App\Models\Job;
use App\Repositores\Contracts\JobRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class JobRepository implements JobRepositoryInterface {

    protected Job $entity;

    public function __construct(Job $entity){
        $this->entity = $entity;
    }

    public function showAllJobs(){
        return $this->entity->simplePaginate(request('limit') ?? 10);
    }

    public function showOneJob($id){
        return $this->entity->findOrFail($id);
    }

    public function create(Request $request){
        $data = $request->all();
        $data['creator_id'] = Auth::user()->getAuthIdentifier();

        $dados = $this->entity->create($data);
        return $dados;
    }

    public function update(Request $request, $id){
        $data = $request->all();

        $dados = $this->entity->findOrFail($id);
        $dados->update($data);

        return $dados->refresh();
    }

    public function delete($id): void{
        $dados = $this->entity->findOrFail($id);
        $dados->delete();
    }
}
