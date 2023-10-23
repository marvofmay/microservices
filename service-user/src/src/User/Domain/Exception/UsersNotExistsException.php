<?php

namespace App\User\Domain\Exception;

use Exception;

class UsersNotExistsException extends Exception
{
    public function __construct($message = 'Users not exists', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}