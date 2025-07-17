<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\SecurityBundle\Security;

readonly class LoggedOutAjaxListener
{
    public function __construct(
        private Security              $security,
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();
        if (($request->getAcceptableContentTypes()[0] ?? '') !== 'application/json') {
            // Not an ajax request
            return;
        }

        if ($event->getThrowable() instanceof AccessDeniedException === false) {
            // Pass all other exceptions to the next exception listener
            return;
        }

        if ($this->security->isGranted('ROLE_USER')) {
            // The user is logged in already, the access denied exception is for something else
            return;
        }

        // Redirect to log in screen when user is not logged in
        $event->setResponse(
            new RedirectResponse(
                $this->urlGenerator->generate('logout')
            )
        );
    }
}