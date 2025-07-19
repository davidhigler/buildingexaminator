<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;

class RateLimiterEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly RateLimiterFactory $rateLimiterFactory)
    {
    }

    /**
     * @inheritDoc
     */
    #[ArrayShape([RequestEvent::class => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $requestEvent): void {
        $request = $requestEvent->getRequest();
        if(str_contains((string) $request->get("_route"), 'api-v1-')) {
            $limiter = $this->rateLimiterFactory->create($request->getClientIp());
            if (false === $limiter->consume(1)->isAccepted()) {
                throw new TooManyRequestsHttpException();
            }
        }
    }
}