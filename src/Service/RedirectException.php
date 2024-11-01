<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectException extends \Exception
{
    private $redirectResponse;

    public function __construct(RedirectResponse $redirectResponse, $message = '', $code = 0, \Exception $previousException = null)
    {
        $this->redirectResponse = $redirectResponse;
        parent::__construct($message, $code, $previousException);
    }

    public function getRedirectResponse()
    {
        return $this->redirectResponse;
    }
}