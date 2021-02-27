<?php

namespace App\Validators;

use App\Enums\JobStatus;
use Illuminate\Validation\Rule;

class JobValidator
{
    public $ruleCreate;
    public $customMessage;

    public function __construct()
    {
        $this->rule = [
            'title' => 'required|max:256',
            'description' => 'required|max:10000',
            'status' => ['required', Rule::in(JobStatus::ACTIVE, JobStatus::INACTIVE)],
            'workplace' => 'array',
            'state' => 'string',
            'city' => 'string',
            'district' => 'string',
            'number' => 'numeric|min:0',
            'salary' => 'numeric|min:0'
        ];

        $this->customMessage = [
            "status.in" => "The :attribute field is invalid, necessary status(" . JobStatus::ACTIVE . ", " . JobStatus::INACTIVE . ")"
        ];
    }
}
