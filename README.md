# Stack Runner

A simple PSR-15 compatible middleware dispatcher. 

## Requirements

 * A stack of [PSR-15](https://github.com/http-interop/http-middleware) middleware, such as [Router](https://github.com/ideationnet/router-middleware) or [Middlewares](https://github.com/middlewares/psr15-middlewares)
 * A [PSR-17 HTTP factory](https://github.com/http-interop/http-factory)
 * An invoker compatible with [InvokerInterface](https://github.com/PHP-DI/Invoker/blob/master/src/InvokerInterface.php)

## Install

Via Composer

```bash
$ composer require ideationnet/stack-runner
```

## Usage

To instantiate directly, provide the stack of middleware,
the invoker to use, and the response factory:

```php
$runner = new IdNet\StackRunner($middleware, $invoker, $factory);
$response = $runner->dispatch($request);
```

Although you will probably use with your preferred
[DI Container](https://github.com/container-interop/container-interop)
rather than instantiating directly:

```php
$runner = $container->get(StackRunner::class);
```

Here's configuration for [PHP-DI](http://php-di.org/), which is 
preferred, as the container also doubles as a compatible `Invoker`:

```php
return [
    StackRunner::class => object()
        ->constructorParameter('stack', get('middleware')),
];
```

## Security

If you discover any security related issues, please email
darren@darrenmothersele.com instead of using the issue tracker.


## Credits

- [Darren Mothersele](http://www.darrenmothersele.com)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [License File](License.md) for more information.

