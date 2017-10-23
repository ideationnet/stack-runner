<?php

namespace IdNet\StackRunnerTest;

use IdNet\StackRunner\StackRunner;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Invoker\InvokerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StackRunnerTest extends TestCase
{
    public function testEmptyStackRunner()
    {
        $runner = $this->getStackRunner([]);
        $response = $runner->handle($this->getTestRequest());
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testNonEmptyStackRunner()
    {
        $runner = $this->getStackRunner([$this->getTestHandler()]);
        $response = $runner->handle($this->getTestRequest());
        $this->assertEquals($response->getStatusCode(), 200);
    }

    private function getTestHandler()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
          ->getMockForAbstractClass();
        return $handler;
    }

    private function getTestRequest()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMockForAbstractClass();
        return $request;
    }

    private function getTestResponse()
    {
        $response = $this->getMockBuilder(ResponseInterface::class)
          ->setMethods(['getStatusCode'])
          ->getMockForAbstractClass();
        $response->method('getStatusCode')->willReturn(200);
        return $response;
    }

    private function getStackRunner($stack)
    {
        $invoker = $this->getMockBuilder(InvokerInterface::class)
            ->getMock();
        $invoker->method('call')->willReturn($this->getTestResponse());

        $factory = $this->getMockBuilder(ResponseFactoryInterface::class)
            ->setMethods(['createResponse'])
            ->getMockForAbstractClass();
        $factory->method('createResponse')->willReturn($this->getTestResponse());

        return new StackRunner($stack, $invoker, $factory);
    }
}
