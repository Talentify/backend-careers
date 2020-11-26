<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return $this->createApiResponseErrors($validator->errors()->toArray(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Crypt::encrypt($request->get('password')),
        ]);

        return $this->createApiResponse($user, Response::HTTP_CREATED);
    }
}
