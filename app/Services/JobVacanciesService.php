<?php


namespace App\Services;

use App\Models\JobVacancies;

class JobVacanciesService
{
    private $vacancie;

    public function __construct(JobVacancies $vacancie)
    {
        $this->vacancie = $vacancie;
    }

    public function create($request)
    {
        return $this->vacancie->create($request->only($this->vacancie->getFillable()));
    }

    public function update($vacancieId, $request)
    {
        $vacancie = $this->vacancie->find($vacancieId);

        if ($vacancie) {
            $vacancie->title = $request->title;
            $vacancie->description = $request->description;
            $vacancie->status = $request->status;
            $vacancie->workplace = $request->workplace;
            $vacancie->salary = $request->salary;
            $vacancie->save();

            return $vacancie;
        } else {
            return null;
        }
    }


    public function show($vacancieId)
    {
        return $this->vacancie->find($vacancieId);
    }

    public function destroy($vacancieId)
    {
        $vacancie = $this->show($vacancieId);
        if ($vacancie) {
            $vacancie->delete();

            return true;
        } else {
            return false;
        }
    }

    public function list()
    {
        $vacancies = JobVacancies::all();

        return $vacancies;
    }
}
