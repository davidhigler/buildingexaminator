<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\LimiterInterface;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Contracts\Service\Attribute\Required;

class RateLimiterEventSubscriber implements EventSubscriberInterface
{
    private LimiterInterface $limiter;

    #[Required]
    public function setLimiter(#[Autowire(service: 'limiter.anonymous_api')] RateLimiterFactory $rateLimiterFactory): void
    {
        $this->limiter = $rateLimiterFactory->create();
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
        if(str_contains((string) $request->get("_route"), 'api-v1-') && false === $this->limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException();
        }
    }
}
