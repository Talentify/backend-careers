<?php


namespace App\Http\Controllers;

use App\Services\Recruiter\RecruiterRegisterService;
use Illuminate\Http\Request;

class RecruiterAccessController extends Controller
{
    public function register(RecruiterRegisterService $service, Request $request): \Illuminate\Http\JsonResponse
    {
        $recruiter = $service->register($request->all());

        return response()->json(['data' => $recruiter], 201);
    }

    public function login(RecruiterRegisterService $service, Request $request)
    {
        $result = $service->login($request->post('email'), $request->post('password'));

        return response()->json(['data' => $result]);
    }
}
