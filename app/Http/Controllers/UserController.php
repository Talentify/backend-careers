<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user, Request $request){
        $this->user = $user;
        $this->request = $request;
    }

    public function store(Request $request){

        $dataForm = $request->all();

        $user = auth()->user();

        $this->user->name = $dataForm['name'];
        $this->user->email = $dataForm['email'];
        $this->user->password = bcrypt($dataForm['password']);
        $this->user->company_name = $dataForm['company_name'];
        $this->user->save();

        return response()->json($this->user, 201);
    }
}
