<?php

namespace IdNet\StackRunner;

use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Invoker\InvokerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StackRunner implements RequestHandlerInterface
{
    /** @var InvokerInterface */
    protected $invoker;

    protected $stack = [];

    protected $current = 0;

    /** @var ResponseFactoryInterface */
    protected $responseFactory;

    public function __construct(
        array $stack,
        InvokerInterface $invoker,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->invoker = $invoker;
        $this->stack = $stack;
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($this->stack[$this->current])) {
            return $this->responseFactory->createResponse();
        }

        $middleware = $this->stack[$this->current];
        $this->current++;

        return $this->invoker->call([$middleware, 'process'], [
            'request' => $request,
            'handler' => $this,
        ]);
    }
}
