# Laravel middleware to grant access based on a local IP white/black list config or an API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/black-bits/laravel-firewall.svg?style=flat-square)](https://packagist.org/packages/black-bits/laravel-firewall)
[![Total Downloads](https://img.shields.io/packagist/dt/black-bits/laravel-firewall.svg?style=flat-square)](https://packagist.org/packages/black-bits/laravel-firewall)
[![StyleCI](https://styleci.io/repos/137923453/shield)](https://styleci.io/repos/137923453)

This Laravel package provides you with a simple IP based white and black list functionality.

It installs a global middleware that checks the visitors IP at every request if enabled (disabled by default).

Blacklisted IPs are always blocked, whitelisted IPs are always granted access except when they are also blacklisted.

All other IPs get checked against an API endpoint of the [Laravel Firewall Service](https://laravel-firewall.io)

The API's intended use is the protection of development and staging environments, while granting convenient, centrally maintained access to e.g. your employees or clients.

### Disclaimer
_This package is currently in development and is not production ready._

## Installation

You can install the package via composer

```bash
composer require black-bits/laravel-firewall
```

Next you can publish the config and view

```bash
php artisan vendor:publish --provider="BlackBits\LaravelFirewall\LaravelFirewallServiceProvider"
```

## Usage

To enable the plugin simply publish the config and set `FIREWALL_ENABLED=true` in your `.env` file.

There are two ways to grant access to an IP: 
1. Add it to the `whitelist` array in the config file.
2. Register the IP for your app with our [Laravel Firewall Service](https://laravel-firewall.io)

You can use the `blacklist` config array to always block access to specific IPs.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

### Security

If you discover any security related issues, please email [hello@blackbits.io](mailto:hello@blackbits.io) instead of using the issue tracker.

## Credits

- [Oliver Heck](https://github.com/oheck)
- [Andreas Przywara](https://github.com/aprzywara)
- [Adrian Raeuchle](https://github.com/araeuchle)
- [All Contributors](../../contributors)

## Support us

Black Bits, Inc. is a web and consulting agency specialized in Laravel and AWS based in Grants Pass, Oregon. You'll find an overview of what we do [on our website](https://blackbits.io).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
