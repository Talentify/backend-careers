<?php

namespace App\Repositores\Contracts;

use Illuminate\Http\Request;

interface JobRepositoryInterface {

    /**
     * Display a listing of the resource.
     */
    public function showAllJobs();

    /**
     * Create a newly created resource in storage.
     * @param Request $request
     */
    public function create(Request $request);

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function showOneJob($id);


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id);

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function delete($id);
}
