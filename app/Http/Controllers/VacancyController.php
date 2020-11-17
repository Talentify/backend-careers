<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = auth()->user()->vacancies;
        return view('vacancy.index', compact('vacancies'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        if (Vacancy::create($request->except('_token'))) {
            return redirect(route('vacancies.index'))->with('success', trans('Vaga cadastrada com sucesso!'));
        }
        return redirect(route('vacancies.create'))->with('error', trans('Devido a um erro não foi possível cadastrar a vaga. Tente novamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        if ($vacancy->delete()) {
            return redirect(route('vacancies.index'))->with('warning', trans('Vaga apagada com sucesso'));
        }
        return redirect(route('vacancies.index'))->with('error', trans('Devido a um erro não foi possível apagar a vaga. Tente novamente.'));
    }
}
