<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exceptions\JobNotFoundException;
use App\Models\Job;
use PDOException;

class JobController
{
    /* VIEW ROUTES */
    public static function index(Request $request)
    {
        UserController::verifySession();

        $list = (new Job())->all(0);

        return view('admin.jobs.list', ['jobs' => $list]);
    }

    public static function show($id = 0)
    {
        UserController::verifySession();

        try {
            $job = (new Job())->getById((int)$id);
            if (!empty($id) && !$job) {
                throw new JobNotFoundException();
            }

            return view('admin.jobs.form', ['job' => $job]);
        } catch (JobNotFoundException $e) {
            abort(404);
        }
    }

    /* ACTION ROUTES */
    public static function create(Request $request)
    {
        try {
            $params = $request->toArray();
            $params['created_at'] = date('Y-m-d H:i:s');

            $job = new Job($params);
            $job->validate();

            $job = $job->insert();
            if (!$job) {
                throw new JobNotFoundException();
            }

            return response()->json(['status' => 'ok', 'created' => $job], 201);
        } catch (JobNotFoundException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public static function update(Request $request, $id)
    {
        try {
            $params = $request->toArray();
            $params['id'] = (int)$id;
            $params['updated_at'] = date('Y-m-d H:i:s');

            $job = new Job($params);
            $job->validate();

            $job = $job->update();
            if (!$job) {
                throw new JobNotFoundException();
            }

            return response()->json(['status' => 'ok', 'updated' => $job]);
        } catch (JobNotFoundException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        } catch (PDOException $e) {
            dd($e);
        }
    }

    public static function remove($id)
    {
        try {
            $job = (new Job())->getById((int)$id);
            if (!empty($id) && !$job) {
                throw new JobNotFoundException();
            }

            $newJob  = new Job($job);
            $deleted = $newJob->remove();
            if (!$deleted) {
                throw new JobNotFoundException();
            }

            return response()->json(['status' => 'ok', 'deleted' => $deleted]);
        } catch (JobNotFoundException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        } catch (PDOException $e) {
            dd($e);
        }
    }
}
