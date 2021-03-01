<?php

namespace App\Repositories;

use App\Models\Address;
use Recruitment\Modules\Jobs\Create\Entities\Address as CreateAddress;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateAddressException;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteAddressException;
use Recruitment\Modules\Jobs\Delete\Requests\Request;
use Recruitment\Modules\Jobs\Update\Entities\Address as UpdateAddress;

class AddressRepository
{
    private $model = Address::class;

    public function create(CreateAddress $address)
    {
        try {
            $job = $this->model::create(
                [
                    'address' => $address->getAddress(),
                    'number' => $address->getNumber(),
                    'city' => $address->getCity(),
                    'state' => $address->getState(),
                    'country' => $address->getCountry(),
                    'complement' => $address->getComplement(),
                    'job_id' => $address->getJobId()
                ]
            );

            return (new CreateAddress(
                $job->address,
                $job->number,
                $job->city,
                $job->state,
                $job->country,
                $job->complement
            ))->setJobId($job->job_id);

        } catch (\Exception $exception) {
            throw new CreateAddressException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function update(UpdateAddress $address): void
    {
        try {
            $this->model::where('job_id', $address->getJobId())->update(
                [
                    'address' => $address->getAddress(),
                    'number' => $address->getNumber(),
                    'city' => $address->getCity(),
                    'state' => $address->getState(),
                    'country' => $address->getCountry(),
                    'complement' => $address->getComplement(),
                    'job_id' => $address->getJobId()
                ]
            );
        } catch (\Exception $exception) {
            throw new CreateAddressException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function delete(Request $request): void
    {
        try {
            $this->model::where('job_id', $request->getId())->delete();
        } catch (\Exception $exception) {
            throw new DeleteAddressException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
