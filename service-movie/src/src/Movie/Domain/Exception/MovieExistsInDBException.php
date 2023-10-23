<?php

namespace App\Movie\Domain\Exception;

use Exception;

class MovieExistsInDBException extends \Exception
{
    public function __construct($message = 'Movie exists in DB', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}