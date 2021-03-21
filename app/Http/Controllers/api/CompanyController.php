<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $details;

    public function __construct(){
        $this->details = ["model" => Company::class];
    }

    public function index()
    {
        return $this->details['model']::all();
    }

    public function store(Request $request)
    {
        $this->details['model']::create($request->all());
        return $this->index();
    }

    public function show($id)
    {
        return $this->details['model']::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
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
