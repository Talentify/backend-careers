<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Requests\JobActionRequest;
use App\Http\Requests\JobEntityRequest;
use Illuminate\Http\Request;

use App\Repositores\Contracts\JobRepositoryInterface;
use Laravel\Lumen\Routing\Controller;

class JobController extends Controller
{
    protected JobRepositoryInterface $entity;

    public function __construct(JobRepositoryInterface $entity){
        $this->entity = $entity;
    }

    /**
     * @OA\Get(
     *     path="/jobs",
     *     summary="get all jobs",
     *     description="Fetch all jobs with pagination",
     *     operationId="showAllJobs",
     *     tags={"jobs"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="maximum number of results to return",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="number of page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function showAllJobs()
    {
        return $this->entity->showAllJobs();
    }

    /**
     * @OA\Post(
     *     path="/manage/jobs",
     *     summary="create a job",
     *     tags={"jobs"},
     *     description="createa a new job",
     *     operationId="create",
     *     security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"title","description", "status"},
     *                  @OA\Property(
     *                      property="title",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      enum={"OPEN", "OPEN", "STANDBY", "FINISHED", "CLOSED"}
     *                  ),
     *                  @OA\Property(
     *                      property="workplace",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="salary",
     *                      type="number",
     *                      format="float"
     *                  )
     *                )
     *             ),
     *     ),
     *     @OA\Response(response=200,description="OK"),
     *     @OA\Response(
     *          response=422,
     *          description="invalid post data",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorValidation"),
     *     ),
     *     @OA\Response(response=401,description="unauthenticated user")
     * )
     */
    public function create(JobEntityRequest $request)
    {
        return response($this->entity->create($request), 201);
    }

    /**
     * @OA\Get(
     *     path="/jobs/{id}",
     *     summary="get a job",
     *     tags={"jobs"},
     *     description="get specific job informed by id",
     *     operationId="showOneJob",
     *     @OA\Parameter(
     *         description="ID of job to fetch",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response=200,description="OK"),
     *     @OA\Response(response=404,description="Not found job by id"),
     * )
     */
    public function showOneJob(JobActionRequest $request, $id)
    {
        return $this->entity->showOneJob($id);
    }

    /**
     * @OA\Put(
     *     path="/manage/jobs/{id}",
     *     summary="update a job",
     *     tags={"jobs"},
     *     description="update specific job informed by id",
     *     operationId="create",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *         description="ID of job to update",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"title","description", "status"},
     *                  @OA\Property(
     *                      property="title",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      enum={"OPEN", "OPEN", "STANDBY", "FINISHED", "CLOSED"}
     *                  ),
     *                  @OA\Property(
     *                      property="workplace",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="salary",
     *                      type="number",
     *                      format="float"
     *                  )
     *                )
     *             ),
     *     ),
     *     @OA\Response(response=200,description="OK"),
     *     @OA\Response(response=404,description="Not found job by id"),
     *     @OA\Response(
     *          response=422,
     *          description="invalid post data",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorValidation"),
     *     ),
     *     @OA\Response(response=401,description="unauthenticated user")
     * )
     */
    public function update(JobEntityRequest $request, $id)
    {
        return $this->entity->update($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/manage/jobs/{id}",
     *     summary="delete a job",
     *     tags={"jobs"},
     *     description="delete specific job informed by id",
     *     operationId="delete",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *         description="ID of job to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response=200,description="OK"),
     *     @OA\Response(response=404,description="Not found job by id"),
     * )
     */
    public function delete(JobActionRequest $request, $id)
    {
        return $this->entity->delete($id);
    }
}
