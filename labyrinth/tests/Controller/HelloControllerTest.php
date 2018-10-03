<?php

namespace App\Tests\Controller;

use App\Controller\HelloController;
use PHPUnit\Framework\TestCase;

class HelloControllerTest extends TestCase
{
    public function testSayHelloReturnsHelloWorldString()
    {
        $helloWorld = new HelloController();
        $this->assertSame('Hello World!', $helloWorld->sayHello());
    }
}
