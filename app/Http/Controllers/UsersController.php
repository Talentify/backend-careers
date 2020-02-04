<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{

    public function register(Request $request, UsersService $usersService)
    {
        $rules = [
            'name'     => 'required|string|min:1',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ];

        $messages = [
            'email.exists' => 'This e-mail already exists.'
        ];

        $this->validate($request, $rules, $messages);

        return new JsonResponse($usersService->create($request->all(['name','email','password'])), Response::HTTP_CREATED);

    }
    
    public function update(Request $request, UsersService $usersService)
    {
        $rules = [
            'name'     => 'string|min:1',
            'email'    => 'email|unique:users,email',
            'password' => 'string|min:6'
        ];
    
        $user = $usersService->getAuthUser();
        if($user->email === $request->get('email')){
            unset($rules['email']);
        }
        
        $messages = [
            'email.exists' => 'This e-mail already exists.'
        ];
        
        $this->validate($request, $rules, $messages);
        
        return new JsonResponse($usersService->updateByAuthUser($request->all()), Response::HTTP_OK);
        
    }
    
    public function get(UsersService $usersService)
    {
        return new JsonResponse($usersService->getAuthUser(), Response::HTTP_OK);
    }
    
    public function login(Request $request, UsersService $usersService)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|string'
        ];
    
        $this->validate($request, $rules);
    
        $user = $usersService->login($request->get('email'), $request->get('password'));
        
        return new JsonResponse($user, Response::HTTP_OK);
    }

}
