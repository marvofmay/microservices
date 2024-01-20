<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Exception;

use Exception;

class MovieNotFindByUUIDException extends Exception
{
    public function __construct($message = 'Movie not found by uuid', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}