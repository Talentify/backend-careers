<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    private $details;

    public function __construct(){
        $this->details = ["model" => User::class];
    }

    public function index()
    {
        return $this->details['model']::where("id","<>","1")->get();
    }

    public function store(Request $request)
    {
        $request['password'] = bcrypt($request['password']);
        $this->details['model']::create($request->all());
        return $this->index();
    }

    public function show($id)
    {
        return $this->details['model']::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request['password'] = bcrypt($request['password']);

        $empresa = $this->details['model']::findOrFail($id);
        $empresa->update($request->all());
        return $this->show($id);
    }

    public function destroy($id)
    {
        $empresa = $this->details['model']::findOrFail($id);
        $empresa->delete();
        return $this->index();
    }
}
