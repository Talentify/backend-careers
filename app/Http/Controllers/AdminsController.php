<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminsService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminsController extends Controller
{
    
    
    public function register(Request $request, AdminsService $adminsService)
    {
        $rules = [
            'name'     => 'required|string|min:1',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6'
        ];
        
        $messages = [
            'email.exists' => 'This e-mail already exists.'
        ];
        
        $this->validate($request, $rules, $messages);
        
        return new JsonResponse($adminsService->create($request->all(['name','email','password'])), Response::HTTP_CREATED);
        
    }
    
    public function update(Request $request, AdminsService $adminsService)
    {
        $rules = [
            'name'     => 'string|min:1',
            'email'    => 'email|unique:admins,email',
            'password' => 'string|min:6'
        ];
        
        $admin = $adminsService->getAuthAdmin();
        if($admin->email === $request->get('email')){
            unset($rules['email']);
        }
        
        $messages = [
            'email.exists' => 'This e-mail already exists.'
        ];
        
        $this->validate($request, $rules, $messages);
        
        return new JsonResponse($adminsService->updateByAuthAdmin($request->all()), Response::HTTP_OK);
        
    }
    
    public function get(AdminsService $adminsService)
    {
        return new JsonResponse($adminsService->getAuthAdmin(), Response::HTTP_OK);
    }
    
    public function login(Request $request, AdminsService $adminsService)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|string'
        ];
        
        $this->validate($request, $rules);
        
        $admin = $adminsService->login($request->get('email'), $request->get('password'));
        
        return new JsonResponse($admin, Response::HTTP_OK);
    }

}
