<?php

namespace App\tests\User\Unit\User;

use App\User\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testIsInstanceOfUser()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }
}