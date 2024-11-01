<?php


namespace App\listeners;

use App\Service\RedirectException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;


class RedirectExceptionListener
{
    public function onKernelException(ExceptionEvent  $event)
    {
        if ($event->getException() instanceof RedirectException) {
            $event->setResponse($event->getException()->getRedirectResponse());
        }
    }
}