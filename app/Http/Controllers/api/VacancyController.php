<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    private $details;

    public function __construct(){
        $this->details = ["model" => Vacancy::class];
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
        $request['password'] = bcrypt($request['password']);

        $response = $this->details['model']::findOrFail($id);
        $response->update($request->all());
        return $this->show($id);
    }

    public function destroy($id)
    {
        $response = $this->details['model']::findOrFail($id);
        $response->delete();
        return $this->index();
    }

    public function myvacancies($id){
        return $this->details['model']::where('id_recruiter', $id)->get();
    }

    public function filtervacancies(Request $request){
        $response = $this->details['model']::Where('title', 'like', '%'.$request['search'].'%')
            ->orWhere('description', 'like', '%'.$request['search'].'%')
            ->orWhere('salary', 'like', '%'.$request['search'].'%')
            ->orWhere('company', 'like', '%'.$request['search'].'%')
            ->orWhere('address', 'like', '%'.$request['search'].'%')
            ->get();
        return $response;
    }
}
