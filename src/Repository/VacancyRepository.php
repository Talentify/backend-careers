<?php

namespace App\Repository;

use App\Domain\Entity\Vacancy;
use App\Domain\ValuesObjects\VacancyList;
use App\Factories\VacancyFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Domain\Repositories\VacancyRepositoryInterface as VacancyPort;

class VacancyRepository extends Eloquent implements VacancyPort
{
    protected $table = 'vacancies';
    protected $fillable = [
        'title', 'description', 'workplace', 'salary', 'status',
    ];

    /**
     * @inheritDoc
     */
    public function getById(int $id): Vacancy
    {
        $resource = self::find($id);

        return VacancyFactory::make(
            $id,
            $resource->title,
            $resource->description,
            $resource->workplace,
            $resource->salary,
            $resource->status
        );
    }

    /**
     * @inheritDoc
     */
    public function index(): VacancyList
    {
        $vacancies = self::all()->toArray();

        return new VacancyList($vacancies);
    }

    /**
     * @inheritDoc
     */
    public function active(): VacancyList
    {
        $vacancies = self::where('status', 1)->get()->toArray();

        return new VacancyList($vacancies);
    }

    /**
     * @param array $data
     * @return Vacancy
     */
    public function create(array $data): Vacancy
    {
        return self::create($data);
    }
}