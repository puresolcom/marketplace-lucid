<?php

namespace App\Domains\User\Exceptions;

use Awok\Foundation\Exceptions\Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct(
        $message = 'Invalid credentials were supplied',
        $code = 401,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}