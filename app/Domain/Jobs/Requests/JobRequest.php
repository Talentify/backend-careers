<?php


namespace App\Domain\Jobs\Requests;


use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModelInterface;
use Core\Requests\AbstractCrudRequest;
use Domain\Jobs\DTOs\JobDTO;
use Domain\Jobs\Models\Job;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends AbstractCrudRequest
{
    public function getDTO(): AbstractDTOInterface
    {
        return app(JobDTO::class);
    }

    /**
     * @return AbstractModelInterface|Model
     */
    public function getModel(): AbstractModelInterface
    {
        return app(Job::class);
    }

    public function validateToDTO(): AbstractDTOInterface
    {
        $jobData = $this->validated();
        return new JobDTO($jobData);
    }

    public function getGetOneRules(): array
    {
        return $this->rules();
    }

    public function getSaveOneRules(): array
    {
        return [
            'title' => ['string', 'required'],
            'description' => ['string', 'nullable'],
            'salary' => ['numeric', 'nullable'],
            'address.street' => ['string', 'nullable'],
            'address.city' => ['string', 'nullable'],
            'address.state' => ['string', 'nullable'],
            'address.state_full' => ['string', 'nullable'],
            'address.zip_code' => ['string', 'nullable'],
        ];
    }

    public function getUpdateOneRules(): array
    {
        return array_merge(['status' => ''], $this->getSaveOneRules());
    }

    public function getDeleteOneRules(): array
    {
        return $this->rules();
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
