<?php

namespace App\Auth\Services;

use App\Auth\Exceptions\UserNotFoundOnThisClientException;
use App\Clients\Models\Client;
use App\Clients\Services\ClientService;
use App\Users\Exceptions\UserNotFoundException;
use App\Users\Models\User;
use App\Users\Services\UserService;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/**
 * Class AuthService
 * @package App\Auth\Services
 */
class AuthService
{

    /**
     * The password token repository.
     *
     * @var TokenRepositoryInterface
     */
    protected $tokens;

    /**
     * @var ClientService
     */
    private $clientService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * AuthService constructor.
     *
     * @param  ClientService  $clientService
     * @param  UserService  $userService
     */
    public function __construct(
        ClientService $clientService,
        UserService $userService
    ) {
        $this->tokens = Password::getRepository();
        $this->clientService = $clientService;
        $this->userService = $userService;
    }

    /**
     * @param $value
     * @return UserNotFoundException|User
     */
    public function findByUsername($value)
    {
        return $this->userService->findByUsername($value);
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getClientByOrigin(Request $request)
    {
        $origin = $request->headers->get('origin');
        return $this->clientService->getClientByOrigin($origin);
    }

    /**
     * @param  User  $user
     * @param  Client  $client
     */
    public function verifyClientRelation(User $user, Client $client)
    {
        if (!$user->clients->contains($client)) {
            throw new UserNotFoundOnThisClientException();
        }
    }

    /**
     * @param  array  $credentials
     * @param  Client  $client
     *
     * @return mixed
     */
    public function attemptCredentials(array $credentials, Client $client)
    {
        $customClaims = [
            'aud' => $client->id,
            'cky' => $client->key,
            'ctk' => $client->token,
        ];

        return auth('api')->claims($customClaims)
            ->attempt($credentials);
    }

    /**
     * @param  Request  $request
     */
    public function renew(Request $request)
    {
        return auth()->guard('api')->refresh();
    }

    /**
     * @param  Request  $request
     */
    public function logout(Request $request)
    {
        auth()->guard('api')->logout();
    }
}
