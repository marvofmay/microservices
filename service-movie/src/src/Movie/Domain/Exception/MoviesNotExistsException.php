<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Exception;

use Exception;

class MoviesNotExistsException extends \Exception
{
    public function __construct($message = 'Movies not exists in DB', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}