<?php


namespace Tests;


use App\Models\Company;
use Illuminate\Http\Request;

trait CreateRequestTrait
{
    public function create(string $method, array $requestData): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($requestData);

        return $request;
    }
}