<?php
namespace App\Authenticator;

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

class TokenAuthenticator implements AuthenticatorInterface
{
    const TOKEN_HEADER = 'X-AUTH-TOKEN';

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has(self::TOKEN_HEADER);
    }

    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): PassportInterface
    {
        try {
            return new PassportModel($this->userService->find([
                'token' => $request->headers->get(self::TOKEN_HEADER)
            ], null, null, null)[0]);
        } catch (NoResultException $exception) {
            throw new UnauthorizedHttpException('');
        }
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
     * @param AuthenticationException $exception
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(null, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }
}