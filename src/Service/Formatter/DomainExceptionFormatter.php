<?php

namespace App\Service\Formatter;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DomainExceptionFormatter implements EventSubscriberInterface
{
    #[ArrayShape([KernelEvents::EXCEPTION => "string"])] public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException'
        );
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof \DomainException) {
            return;
        }

        $event->setResponse(
            new JsonResponse([
                'error' => [
                    'message' => $exception->getMessage(),
                ]
            ], 400)
        );
    }
}