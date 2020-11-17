<?php


namespace Domain\Jobs\Requests;


use Core\Requests\AbstractRequest;

final class JobSearchRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'term' => ['string', 'required']
        ];
    }
}
