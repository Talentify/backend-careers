<?php


namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'getDomainException'
        ];
    }

    public function getDomainException(ExceptionEvent $event)
    {
        $e = $event->getThrowable();

        $content = ['message' => $e->getMessage()];
        $headers = ['Content-Type' => 'application/json'];
        $status  = $e->getCode() < 100 || $e->getCode() > 500 ? 500 : $e->getCode();

        error_log(json_encode($content));

        $response = new Response(json_encode($content), $status, $headers);
        $event->setResponse($response);
    }
}
