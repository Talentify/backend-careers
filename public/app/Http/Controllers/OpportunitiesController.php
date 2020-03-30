<?php

namespace App\Http\Controllers;

use App\Opportunities;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $opportunity = Opportunities::findOrFail($id);

        return view('opportunity', compact('opportunity'));
    }
}
