<?php
namespace App\Authenticator;

use App\Entity\User;
use App\Model\PassportModel;
use App\Model\TokenModel;
use App\Service\UserService;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class PasswordAuthenticator implements AuthenticatorInterface
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * PasswordAuthenticator constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        $data = json_decode($request->getContent(), true);
        return is_null($data) === false
            && $request->headers->has(TokenAuthenticator::TOKEN_HEADER) === false
            && array_key_exists('username', $data)
            && array_key_exists('password', $data);
    }

    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): PassportInterface
    {
        return new PassportModel($this->validateUser(json_decode($request->getContent(), true)));
    }

    /**
     * @param PassportInterface $passport
     * @param string $firewallName
     * @return TokenInterface
     */
    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): TokenInterface
    {
        if ($passport instanceof PassportModel === false) {
            throw new \InvalidArgumentException();
        }
        $token = new TokenModel([]);
        $token->setUser($passport->getUser());
        return $token;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(null, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param array $data
     * @return User
     */
    private function validateUser(array $data): User
    {
        try {
            $user = $this->userService->find(['username' => $data['username'] ?? ''], null, null, null)[0];
            if (password_verify($data['password'] ?? '', $user->getPassword()) === false) {
                throw new UnauthorizedHttpException('');
            }
            return $user;
        } catch (NoResultException $exception) {
            throw new UnauthorizedHttpException('');
        }
    }
}