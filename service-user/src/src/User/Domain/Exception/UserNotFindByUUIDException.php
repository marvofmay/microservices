<?php

namespace App\User\Domain\Exception;

use Exception;

class UserNotFindByUUIDException extends Exception
{
    public function __construct($message = 'User not found by uuid', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}