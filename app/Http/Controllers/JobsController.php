<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\JobsStatus;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Validate login request.
     *
     * @param Request $request
     */
    protected function validateJobs(Request $request)
    {

        $validate = [
            'title' => 'required|string|max:256',
            'description' => 'required|string|max:10000'
        ];
        if ($request->salary) {
            $validate['salary'] = 'numeric|max:9999999999';
        }
        if ($request->workplace) {
            $validate['workplace'] = 'max:10000';
        }
        $request->validate($validate);
    }

    /**
     * Create new job.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateJobs($request);
        try  {
            $all = $request->all();
            $all['status'] = JobsStatus::DISABLE;
            if ($request->status) {
                $all['status'] = JobsStatus::ENABLE;
            }
            Jobs::create($all);
            return redirect('dashboard')->with('sucess', __('Job successfully added!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('Undefined error'));
        }
    }
}
