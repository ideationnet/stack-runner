<?php

namespace IdNet\StackRunner;

use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Invoker\InvokerInterface;
use Psr\Http\Message\ServerRequestInterface;

class StackRunner implements DelegateInterface
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

    public function process(ServerRequestInterface $request)
    {
        if (!isset($this->stack[$this->current])) {
            return $this->responseFactory->createResponse();
        }

        $middleware = $this->stack[$this->current];
        $this->current++;

        return $this->invoker->call([$middleware, 'process'], [
            'request' => $request,
            'delegate' => $this,
        ]);
    }
}
