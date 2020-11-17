<?php


namespace App\Core\Requests;


interface AbstractRequestInterface
{
    public function authorize(): bool;

    public function rules(): array;
}
