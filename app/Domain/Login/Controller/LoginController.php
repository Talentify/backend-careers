<?php

namespace App\Domain\Login\Controller;

use App\Domain\Recruiters\Service\RecruiterService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
    		$recruiter = Auth::user();
            
    		$dados['accessToken'] = $recruiter->createToken($recruiter->name)->accessToken;
    		$dados['name'] = $recruiter['name'];

    		return response()->json(['data' => $dados], Response::HTTP_OK);
    	}
    	else{
            return response()->json(['erros' => 'User not exist!'], Response::HTTP_UNAUTHORIZED);
    	}
    }
}