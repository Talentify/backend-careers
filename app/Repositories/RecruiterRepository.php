<?php

namespace App\Repositories;

use App\Models\Recruiter;
use Illuminate\Support\Facades\Hash;
use Recruitment\Modules\Recruiters\Login\Exceptions\CredentialsNotFoundException;
use Recruitment\Modules\Recruiters\Login\Exceptions\GetRecruiterCredentialsException;
use Recruitment\Modules\Recruiters\Login\Exceptions\UnauthorizedException;
use Recruitment\Modules\Recruiters\Login\Gateways\GetRecruiterCredentialsGateway;
use Recruitment\Modules\Recruiters\Login\Gateways\UpdateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Exceptions\CpfAlreadyExistsException;
use Recruitment\Modules\Recruiters\Create\Exceptions\CreateRecruiterException;
use Recruitment\Modules\Recruiters\Create\Gateways\CreateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Requests\Request;
use Recruitment\Modules\Recruiters\Create\Entities\Recruiter as CreateRecruiter;

class RecruiterRepository implements CreateRecruiterGateway, GetRecruiterCredentialsGateway, UpdateRecruiterGateway
{
    private $model = Recruiter::class;

    public function create(Request $request): CreateRecruiter
    {
        try {
            $recruiter = $this->model::where('cpf', $request->getCpf())->first();
        } catch (\Exception $exception) {
            throw new CreateRecruiterException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (!is_null($recruiter)) {
            throw new CpfAlreadyExistsException('This CPF is already in use.', 400);
        }

        try {
            $recruiter = $this->model::firstOrCreate(
                [
                    'name' => $request->getName(),
                    'cpf' => $request->getCpf(),
                    'email' => $request->getEmail(),
                    'password' => Hash::make($request->getPassword()),
                    'company_id' => $request->getCompanyId()
                ]
            );

            return new CreateRecruiter(
                $recruiter->name,
                $recruiter->cpf,
                $recruiter->password,
                $recruiter->email,
                $recruiter->company_id
            );
        } catch (\Exception $exception) {
            throw new CreateRecruiterException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function checkCredentials(\Recruitment\Modules\Recruiters\Login\Requests\Request $request): void
    {
        try {
            $recruiter = $this->model::where('email', $request->getEmail())->first();
        } catch (\Exception $exception) {
            throw new GetRecruiterCredentialsException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (is_null($recruiter)) {
            throw new CredentialsNotFoundException('Email or password not found', 400);
        }

        if (!Hash::check($request->getPassword(), $recruiter->password)) {
            throw new UnauthorizedException('Email or password is invalid.', 400);
        }
    }

    public function updateAccessToken(string $token, string $email)
    {
        try {
             $this->model::where('email', $email)
                ->update(
                    [
                        'access_token' => $token
                    ]
                );
        } catch (\Exception $exception) {
            throw new GetRecruiterCredentialsException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
