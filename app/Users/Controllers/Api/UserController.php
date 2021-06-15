<?php

namespace App\Users\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Users\Controllers\Api\Requests\CreateRequest;
use App\Users\Controllers\Api\Requests\UpdateRequest;
use App\Users\Controllers\Api\Resources\Resource;
use App\Users\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return Resource::collection(User::withTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->email_verified_at = now();
        $user->save();

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function enable(User $user)
    {
        $user->restore();
        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function disable(User $user)
    {
        $this->authorize('disable', $user);
        $user->delete();
        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->forceDelete();
        return response()->json($user, Response::HTTP_NO_CONTENT);
    }
}
