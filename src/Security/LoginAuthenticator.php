<?php


namespace App\Security;


use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginAuthenticator extends AbstractGuardAuthenticator
{
    /** @var AdminRepository */
    private $adminRepository;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(AdminRepository $adminRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->adminRepository = $adminRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return null;
    }

    public function supports(Request $request)
    {
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        return [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $this->adminRepository->findOneBy(['email' => $credentials['email']]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return password_verify($credentials['password'], $user->getPassword());
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        /** @var Admin $user */
        $user = $token->getUser();

        return new JsonResponse(['token' => $user->getToken()]);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
