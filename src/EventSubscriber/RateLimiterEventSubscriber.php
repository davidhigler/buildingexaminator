<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;

class RateLimiterEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var RateLimiterFactory
     */
    private $anonymousApiLimiter;

    /**
     * @var RateLimiterFactory
     */
    private $authenticatedApiLimiter;

    public function __construct(RateLimiterFactory $anonymousApiLimiter, RateLimiterFactory $authenticatedApiLimiter)
    {
        $this->anonymousApiLimiter = $anonymousApiLimiter;
        $this->authenticatedApiLimiter = $authenticatedApiLimiter;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void {
        $request = $event->getRequest();
        if(str_contains($request->get("_route"), 'api-v1-')) {
            $limiter = $this->anonymousApiLimiter->create($request->getClientIp());
            if (false === $limiter->consume(1)->isAccepted()) {
                throw new TooManyRequestsHttpException();
            }
        }
    }
}