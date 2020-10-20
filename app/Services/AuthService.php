<?php


namespace App\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        try {

            $isAuthenticated = Auth::attempt($credentials);

            if ($isAuthenticated) {
                return [
                    'access_token' => $this->generateToken(),
                ];
            } else {
                $this->logger->info('Credenciais incorretas', [
                    'credentials' => $credentials
                ]);
                return response()->json([], Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $ex) {

            $this->logger->error('Erro ao autenticar', [
                'credentials'   => $credentials,
                'error-message' => $ex->getMessage(),
                'line'          => $ex->getLine(),
                'file'          => $ex->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function generateToken()
    {
        $token = Auth::user()->createToken("Access-token");
        $token->token->save();

        return $token->accessToken;
    }
}
