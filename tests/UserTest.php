<?php


namespace App\Tests;


use App\Users\Model\Users;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        $this->user = new Users();

        $this->user->setUserName("Vasya");
        $this->user->setPassword("Hello");
    }

    public function testUserName()
    {
        $this->assertEquals("Vasya", $this->user->getUserName());
    }

    public function testUserPassword()
    {
        $this->assertEquals(md5("Hello"), $this->user->getPassword());
    }
}