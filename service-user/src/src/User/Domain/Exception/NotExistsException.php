<?php

declare(strict_types = 1);

namespace App\User\Domain\Exception;

use Exception;
class NotExistsException extends Exception
{
    public function __construct(
        string $message = 'Records not exists',
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}