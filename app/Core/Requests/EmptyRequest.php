<?php


namespace App\Core\Requests;


use Core\Requests\AbstractRequest;

class EmptyRequest extends AbstractRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
