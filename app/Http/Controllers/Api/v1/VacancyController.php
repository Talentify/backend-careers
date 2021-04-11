<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreUpdateRequest;
use App\Http\Requests\StoreUpdateVacanciesFormRequest;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    private $vacancy,$totalPage = 10;

    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vacancies = $this->vacancy->getResults($request->name);

        return response()->json($vacancies,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateVacanciesFormRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id, 'company_id' => auth()->user()->company_id ]);
        $vacancy = $this->vacancy->create($request->all());

        return response()->json($vacancy ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listVacanciesByUser()
    {
        $vacancy = $this->vacancy->where('user_id', auth()->user()->id)->get();

        if(!$vacancy)
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($vacancy ,200);

    }

    public function list(Request $request)
    {
        $vacancy = $this->vacancy->getResult($request->filter, [
            'title',
            'status',
            'address',
            'salary',
            'keyword',
            'companies.name AS company'],
        $this->totalPage);
        if(!$vacancy){
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($vacancy ,200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateVacanciesFormRequest $request, $id)
    {
        $vacancy = $this->vacancy->where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(!$vacancy)
            return response()->json(['error' => 'Not found'], 404);

        $vacancy->update($request->all());

        return response()->json($vacancy ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacancy = $this->vacancy->where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(!$vacancy)
            return response()->json(['error' => 'Not found'], 404);

        $vacancy->delete();

        return response()->json(['sucess' => true] ,204);
    }

}
