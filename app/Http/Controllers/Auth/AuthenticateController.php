<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Input;
use Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Response;
use JWTAuth;

class AuthenticateController extends Controller
{
    public function authenticate()
    {
        // grab credentials from the request
        $credentials = Request::only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return Response::json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return Response::json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        $user = auth()->user();
        return Response::json(compact('token','user'));
    }

    public function getAuthenticatedUser()
{
	try {

		if (! $user = JWTAuth::parseToken()->authenticate()) {
			return response()->json(['user_not_found'], 404);
		}

	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

		return response()->json(['token_expired'], $e->getStatusCode());

	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

		return response()->json(['token_invalid'], $e->getStatusCode());

	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

		return response()->json(['token_absent'], $e->getStatusCode());

	}

	// the token is valid and we have found the user via the sub claim
	return response()->json(compact('user'));
}

public function refreshToken(){

    // Se não mandou o token
    if(!$token = JWTAuth::getToken())
        return response()->json(['error', 'token_not_send'], 401);

    //Se mandou o token correto
        try{
            $token = JWTAuth::refresh();
    //Se mandou o token Invalido
        }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        return response()->json(compact('token'));
    }

}