<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'email'         => 'required|email',
            'password'   => 'required'
        ]);

        if($Validator->fails()) {
            return response()->json(['error' => $Validator->errors()], 422);
        }
        
        return response()
            ->json(
                User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => $request->name,
                ]),
                201
            );
    }

    public function destroy(int $id)
    {
        $qtddatasRemovidos = User::destroy($id);
        if ($qtddatasRemovidos === 0) {
            return response()->json([
                'erro' => 'Not found'
            ], 404);
        }

        return response()->json('', 204);
    }
}
