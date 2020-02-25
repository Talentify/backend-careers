<?php

namespace App\Http\Controllers\Login;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\UsersService;

class AuthController extends Controller
{
    /**
     * @description Check if user is logged and the level
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (UsersService::checkUserLogged()) {
            if (UsersService::checkUserAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('base.jobs');
            }
        }
        return view('login.index');
    }

    /**
     * @description Validate data of login form
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Ooooops, informe todos os dados para efetuar o login!')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Ooooops, informe um e-mail válido!')->render();
            return response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Ooooops, usuário e senha não conferem!')->render();
            return response()->json($json);
        }

        //Last info about the login
        $this->authenticated($request->getClientIp());

        if (UsersService::checkUserAdmin()) {
            $json['redirect'] = route('admin.dashboard');
            return response()->json($json);
        } else {
            $json['redirect'] = route('base.jobs');
            return response()->json($json);
        }
    }

    /**
     * @description Logout process
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        try {
            UsersService::logout();

            if (!UsersService::checkUserLogged()) {
                return redirect()->route('login.check');
            } else {
                throw new \RuntimeException('Erro ao efetuar o logout do usuário.');
            }
        } catch (\RuntimeException $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * @description Update info about date login and remote ip
     * @param string $ip
     */
    public function authenticated(string $ip)
    {
        try {
            $user = UsersService::getUserById(Auth::user()->id);

            if ($user instanceof ModelNotFoundException) {
                throw new ModelNotFoundException('Erro ao localizar o usuário logado');
            }

            $user->update(
                [
                    'last_login_at' => date('Y-m-d H:i:s'),
                    'last_login_ip' => $ip
                ]
            );
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
