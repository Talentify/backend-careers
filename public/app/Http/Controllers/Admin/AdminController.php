<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Opportunities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller {

    /**
     * Opportunities Model
     * @var Opportunities
     */
    protected $opportunity;

    /**
     * Inject the models.
     * @param Opportunities $opportunity
     */
    public function __construct(Opportunities $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    /**
     * Show a list of all the opportunities.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logOut(Request $request)
    {
        Auth::logout();

        return redirect('admin/login');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function search(Request $request)
    {
        return Datatables::of(Opportunities::query())
            ->addColumn('actions', function($row) {
                $editUrl = route('admin.opportunity.edit', $row->id);
                $deleteUrl = route('admin.opportunity.postDelete', $row->id);

                return view('layouts.formActions', compact('editUrl', 'deleteUrl'));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function showCreate()
    {
        // Show the page
        return view('admin.opportunity.create_edit', ['title' => 'Create job opportunity', 'mode' => 'edit']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(Request $request)
    {
        // Declare the rules for the form validation
        $rules = [
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'status'      => 'in:active,paused,inactive',
        ];

        // Validate the inputs
        $validator = Validator::make($request->all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new opportunity
            $saved = $this->store($request);

            // Was the opportunity created?
            if($saved)
            {
                // Redirect to the new opportunity page
                return Redirect::to(route('admin.home'))->with([
                    'title'   => 'Edit job opportunity',
                    'mode'    => 'edit',
                    'error'   => false,
                    'errorMessage' => 'Job opportunity created with success!'
                ]);
            }

            // Redirect to the opportunity create page
            return Redirect::to('admin/opportunity/new')->with([
                'title'   => 'Edit job opportunity',
                'mode'    => 'edit',
                'error'   => true,
                'errorMessage' => 'An error occurred while creating a new job opportunity.'
            ]);
        }

        // Form validation failed
        return Redirect::to('admin/opportunity/new')->with([
            'title'   => 'Edit job opportunity',
            'mode'    => 'edit',
            'error'   => true
        ])->withInput()->withErrors($validator);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $opportunity
     * @return Response
     */
    public function showEdit($id)
    {
        $opportunity = Opportunities::find($id);

        // Show the page
        return view('admin.opportunity.create_edit', [
            'title' => 'Edit job opportunity',
            'mode' => 'edit',
            'opportunity' => $opportunity
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $opportunity
     * @return Response
     */
    public function postEdit(Request $request, $id)
    {
        // Declare the rules for the form validation
        $rules = [
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'status'      => 'in:active,paused,inactive',
        ];

        // Validate the inputs
        $validator = Validator::make($request->all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $saved = $this->update($id, $request);

            // Was the opportunity updated?
            if($saved)
            {
                // Redirect to the new opportunity page
                return Redirect::to(route('admin.home'))->with([
                    'title'   => 'Edit job opportunity',
                    'mode'    => 'edit',
                    'error'   => false,
                    'errorMessage' => 'Job opportunity edited with success!'
                ]);
            }

            // Redirect to the opportunity management page
            return Redirect::to('admin/opportunity/' . $id . '/edit')->with([
                'title'   => 'Edit job opportunity',
                'mode'    => 'edit',
                'error'   => true,
                'errorMessage' => 'An error occurred while editing the job opportunity.'
            ]);
        }

        // Form validation failed
        return Redirect::to('admin/opportunity/' . $id . '/edit')->with([
            'title'   => 'Edit job opportunity',
            'mode'    => 'edit',
            'error'   => true
        ])->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $opportunity
     * @return Response
     */
    public function postDelete($id)
    {
        $deleted = $this->delete($id);

        // Was the opportunity deleted?
        if(empty($deleted))
        {
            // Redirect to the opportunities management page
            return Redirect::to('admin/')->with([
                'error' => false,
                'errorMessage' => 'Job opportunity deleted with success!'
            ]);
        }

        // There was a problem deleting the opportunity
        return Redirect::to('admin/')->with([
            'error' => true,
            'errorMessage', 'An error occurred while deleting the job opportunity.'
        ]);
    }

    /**
     * @param $request
     * @return bool
     */
    public function store(Request $request){
        $salary = !is_null($request->input('salary')) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('salary')))) : null;

        $this->opportunity->title       = $request->input('title');
        $this->opportunity->description = $request->input('description');
        $this->opportunity->status      = $request->input('status');
        $this->opportunity->workplace   = $request->input('workplace');
        $this->opportunity->salary      = $salary;

        return $this->opportunity->save();
    }

    /**
     * @param null $id
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function update($id = null, Request $request){
        if (is_null($id)) {
            throw new \Exception('Invalid id.');
        }

        $this->opportunity = Opportunities::find($id);

        if (empty($this->opportunity)) {
            throw new \Exception('Record not found.');
        }

        $salary = !is_null($request->input('salary')) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('salary')))) : null;

        $this->opportunity->title       = $request->input('title');
        $this->opportunity->description = $request->input('description');
        $this->opportunity->status      = $request->input('status');
        $this->opportunity->workplace   = $request->input('workplace');
        $this->opportunity->salary      = $salary;


        return $this->opportunity->update();
    }

    /*
     * List opportunities
     */
    public function listOpportunities(){
        return Opportunities::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $opportunity
     * @return Response
     */
    public function delete($id)
    {
        $opportunity = Opportunities::find($id);
        $opportunity->delete();
    }
}
