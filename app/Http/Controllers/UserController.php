<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = (new User);

        if (isset($request->page) && $request->page != "") {
            $users = $users->paginate($request->paginate ?? 10);

            return response()->json($users);
        }

        return response()->json($users->get());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = (new User)->create($request->all());

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'A error ocurred while inserting'], 500);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $userId
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $user = (new User)->findOrFail($userId);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  integer $userId
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $userId)
    {
        try {
            $user = (new User)->findOrFail($userId);

            if ($request->user()->role_id == 2 && $userId != $request->user()->id) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            $user->fill($request->all())->save();


            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'A error ocurred while updating'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        try {
            $user = (new User)->findOrFail($userId);
            
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'A error ocurred while deleting'], 500);
        }
    }
}
