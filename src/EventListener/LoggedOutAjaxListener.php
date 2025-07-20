<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEventListener(event: 'kernel.exception', method: 'onKernelException', priority: 8)]
readonly class LoggedOutAjaxListener
{
    public function __construct(
        private Security $security,
    ) {
    }

    public function onKernelException(ExceptionEvent $exceptionEvent): void
    {
        $request = $exceptionEvent->getRequest();
        if (($request->getAcceptableContentTypes()[0] ?? '') !== 'application/json') {
            // Not an ajax request
            return;
        }

        if ($exceptionEvent->getThrowable() instanceof AccessDeniedException === false) {
            // Pass all other exceptions to the next exception listener
            return;
        }

        if ($this->security->isGranted('ROLE_USER')) {
            // The user is logged in already, the access denied exception is for something else
            return;
        }

        // Redirect to log in screen when user is not logged in
        $exceptionEvent->setResponse(
            new Response(null, \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED)
        );
    }
}
