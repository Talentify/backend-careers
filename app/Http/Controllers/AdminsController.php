<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminsController extends Controller
{

    public function register(Request $request, UsersService $usersService)
    {
        $rules = [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];

        $messages = [
            'email.exists' => 'This e-mail already exists.'
        ];

        $this->validate($request, $rules, $messages);

        return new JsonResponse($usersService->create($request->all()), Response::HTTP_CREATED);

    }

}
