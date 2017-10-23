# Stack Runner

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A simple PSR-15 compatible middleware dispatcher. 

__v3 breaking changes__: updated to use "http-interop/http-middleware" v0.5
where Delegate has been replaced with ResponseHandler.

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

[ico-version]: https://img.shields.io/packagist/v/ideationnet/stack-runner.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ideationnet/stack-runner/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ideationnet/stack-runner.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ideationnet/stack-runner.svg?style=flat-square
[ico-packagist]: https://img.shields.io/packagist/v/ideationnet/stack-runner.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ideationnet/stack-runner.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ideationnet/stack-runner
[link-travis]: https://travis-ci.org/ideationnet/stack-runner
[link-scrutinizer]: https://scrutinizer-ci.com/g/ideationnet/stack-runner/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ideationnet/stack-runner
[link-downloads]: https://packagist.org/packages/ideationnet/stack-runner
[link-author]: https://github.com/darrenmothersele
[link-contributors]: ../../contributors
