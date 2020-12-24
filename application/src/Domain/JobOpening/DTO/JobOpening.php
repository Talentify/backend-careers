<?php

namespace App\Domain\JobOpening\DTO;

use App\Infra\Request\JobOpeningRequest;

class JobOpening
{

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $status;

    /**
     * @var App\Domain\JobOpening\Entity\Embeddable\Address
     */
    public $workplace;

    /**
     * @var App\Domain\JobOpening\Entity\Embeddable\Money
     */
    public $salary;

    private function __construct(array $request)
    {
        $this->title = $request['title'];
        $this->description = $request['description'];
        $this->status = $request['status'];
        $this->workplace = $request['workplace'];
        $this->salary = $request['salary'];
    }

    public static function fromRequest(JobOpeningRequest $request)
    {
        return new self([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'workplace' => $request->workplace,
            'salary' => $request->salary
        ]);
    }

}