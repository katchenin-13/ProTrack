<?php

namespace App\Events;

use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class JWTAuthenticationFailureResponseSubscriber implements EventSubscriberInterface
{

    public function __construct(private TokenStorageInterface $tokenStorage, private JWTTokenManagerInterface $JWTManager, private RequestStack $requestStack)
    {
    }

    public function onLexikJwtAuthenticationOnAuthenticationFailure(AuthenticationFailureEvent $event): void
    {
        /** @var JWTAuthenticationFailureResponse $response */
        $response = $event->getResponse();
        // My own processing where I used to have 
        $event->getException()->getToken();
        $response->setMessage("ERROR MESSAGE");
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_authentication_failure' => 'onLexikJwtAuthenticationOnAuthenticationFailure',
        ];
    }
}
