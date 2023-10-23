<?php

namespace App\Tests\User\Unit;

use App\User\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testExample()
    {
        $user = new User();

        $this->assertInstanceOf(User::class, $user);
    }
}