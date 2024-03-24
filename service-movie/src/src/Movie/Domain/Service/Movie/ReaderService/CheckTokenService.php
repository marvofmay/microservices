<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Service\Movie\ReaderService;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CheckTokenService
{
    public function __construct(
        private readonly JWTTokenManagerInterface $jwtManager,
        private string $jwtTokenString = '',
    ) {
        $request = Request::createFromGlobals();
        $authorization = $request->headers->get('Authorization') ?? '';
        $this->jwtTokenString = str_replace('Bearer ', '', $authorization);
    }

    public function verifyToken(): bool
    {
        $this->jwtManager->parse($this->jwtTokenString);

        return true;
    }
}