<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            if (in_array('', $request->only('name', 'email', 'password'))) {
                $json['message'] = $this->message->error('Ooooops, informe todos os dados para efetuar o cadastro!')->render();
                return response()->json($json);
            }

            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $json['message'] = $this->message->error('Ooooops, informe um e-mail válido!')->render();
                return response()->json($json);
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:10|max:100',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:1|max:20'
                ]
            );

            if ($validator->fails()) {
                $json['message'] = $this->message->error($validator->errors()->first())->render();
                return response()->json($json);
            }

            $user = [
                'uuid' => Str::uuid()->toString(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_admin' => 0
            ];

            $userCreate = User::create($user);

            if ($userCreate instanceof User) {

               (new LoginController())->login($request);

                $json = [
                    'message' => $this->message->success('Usuário cadastrado com sucesso!')->render(),
                    'redirect' => route('login.check')
                ];
                return response()->json($json);
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
