<?php

namespace Application\Sonata\UserBundle\Authentication;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($user->hasRole('ROLE_SONATA_ADMIN')
            || $user->hasRole('ROLE_ADMIN')) {
            return new RedirectResponse(
                $this->router->generate('sonata_admin_dashboard')
            );

        } elseif ($user->hasRole('ROLE_USER')) {
            return new RedirectResponse(
                $this->router->generate('jat_frontend_home')
            );

        } else {
            return new RedirectResponse(
                $this->router->generate('jat_frontend_home')
            );
        }
    }
}