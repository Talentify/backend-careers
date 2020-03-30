<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Opportunities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        return Datatables::of(Opportunities::query())
            ->addColumn('actions', function($row) {
                $editUrl = route('admin.opportunity.getEdit', $row->id);
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
    public function create()
    {
        // Show the page
        return view('admin.opportunity.create_edit', ['title' => 'Create job opportunity', 'mode' => 'edit']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Declare the rules for the form validation
        $rules = [
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'status'      => 'in:active,paused,inactive',
        ];

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new opportunity
            $this->opportunity->title       = Input::get('title');
            $this->opportunity->description = Input::get('description');
            $this->opportunity->status      = Input::get('status');
            $this->opportunity->workplace   = Input::get('workplace');
            $this->opportunity->salary      = Input::get('salary');

            // Was the opportunity created?
            if($this->opportunity->save())
            {
                // Redirect to the new opportunity page
                return Redirect::to('admin/opportunity/' . $this->opportunity->id . '/edit')->with([
                    'title'   => 'Edit job opportunity',
                    'mode'    => 'edit',
                    'error'   => false,
                    'errorMessage' => 'Job opportunity created with success!'
                ]);
            }

            // Redirect to the opportunity create page
            return Redirect::to('admin/opportunity/create')->with([
                'title'   => 'Edit job opportunity',
                'mode'    => 'edit',
                'error'   => true,
                'errorMessage' => 'An error occurred while creating a new job opportunity.'
            ]);
        }

        // Form validation failed
        return Redirect::to('admin/opportunity/create')->with([
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
    public function getEdit($id)
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
    public function postEdit($opportunity)
    {

        // Declare the rules for the form validation
        $rules = [
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'status'      => 'in:active,paused,inactive',
        ];

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $this->opportunity->title       = Input::get('title');
            $this->opportunity->description = Input::get('description');
            $this->opportunity->status      = Input::get('status');
            $this->opportunity->workplace   = Input::get('workplace');
            $this->opportunity->salary      = Input::get('salary');

            // Was the opportunity updated?
            if($opportunity->save())
            {
                // Redirect to the new opportunity page
                return Redirect::to('admin/opportunity/' . $opportunity->id . '/edit')->with([
                    'title'   => 'Edit job opportunity',
                    'mode'    => 'edit',
                    'error'   => false,
                    'errorMessage' => 'Job opportunity edited with success!'
                ]);
            }

            // Redirect to the opportunity management page
            return Redirect::to('admin/opportunity/' . $opportunity->id . '/edit')->with([
                'title'   => 'Edit job opportunity',
                'mode'    => 'edit',
                'error'   => true,
                'errorMessage' => 'An error occurred while editing the job opportunity.'
            ]);
        }

        // Form validation failed
        return Redirect::to('admin/opportunity/' . $opportunity->id . '/edit')->with([
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
    public function postDelete($opportunity)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $opportunity->id;
            $opportunity->delete();

            // Was the opportunity deleted?
            $opportunity = Opportunities::find($id);

            if(empty($opportunity))
            {
                // Redirect to the opportunities management page
                return Redirect::to('admin/opportunities')->with([
                    'error' => false,
                    'errorMessage' => 'Job opportunity deleted with success!'
                ]);
            }
        }
        // There was a problem deleting the opportunity
        return Redirect::to('admin/opportunities')->with([
            'error' => true,
            'errorMessage', 'An error occurred while deleting the job opportunity.'
        ]);
    }
}
