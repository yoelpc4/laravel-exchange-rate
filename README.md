# Laravel Exchange Rate

[![Packagist][ico-packagist]][link-packagist]
[![Downloads][ico-downloads]][link-packagist]
[![Build][ico-build]][link-build]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Software License][ico-license]](LICENSE.md)
[![Contributor Covenant][ico-code-of-conduct]](CODE_OF_CONDUCT.md)

_Laravel Exchange Rate service._

## Requirement

- [Laravel](https://laravel.com)

## Install

Require this package with composer via command:

```shell
composer require yoelpc4/laravel-exchange-rate
```

## Available Service Providers

Available exchange rate service providers:

- [Free Currency Converter Api](https://free.currencyconverterapi.com)

## Environment Variable

If you're planning to use `Free Currency Converter Api` as a provider. get your api key [here](https://free.currencyconverterapi.com/free-api-key). 
Then add these lines to your .env.

```dotenv
EXCHANGE_RATE_PROVIDER=free_currency_converter_api

FREE_CURRENCY_CONVERTER_API_BASE_URL=https://free.currconv.com/api/v8/
FREE_CURRENCY_CONVERTER_API_KEY=
```

## Package Publication

Publish package configuration via command:

```shell
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\ExchangeRateServiceProvider" --tag=config
```

Publish package resources via command:

```shell
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\ExchangeRateServiceProvider" --tag=resources
```

## Supported Currencies

Get supported currencies

```php
try {
    $supportedCurrencies = \ExchangeRateService::currencies();
} catch (\Psr\Http\Client\ClientExceptionInterface $e) {
    throw $e;
}
```

The return value is an instance of `\Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrenciesInterface` object.

## Latest Exchange Rate

Get latest exchange rate

```php
try {
    $base = 'IDR';
    
    $targets = [
        'USD', 'DZD',
    ];
    
    $latestExchangeRate = \ExchangeRateService::latest($base, $targets);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Psr\Http\Client\ClientExceptionInterface $e) {
    throw $e;
}
```

The return value is an instance of `\Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRateInterface` object.

## Historical Exchange Rate

Get historical exchange rate

```php
try {
    $base = 'IDR';
    
    $targets = [
        'USD', 'DZD',
    ];

    $date = now()->subDays(3)->toDateString();
    
    $historicalExchangeRate = \ExchangeRateService::historical($base, $targets, $date);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Psr\Http\Client\ClientExceptionInterface $e) {
    throw $e;
}
```

The return value is an instance of `\Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRateInterface` object.

## Time Series Exchange Rate

Get time series exchange rate

```php
try {
    $base = 'IDR';
    
    $targets = [
        'USD', 'DZD',
    ];
    
    $startDate = now()->subDays(8)->toDateString();

    $endDate = now()->toDateString();
    
    $timeSeriesExchangeRate = \ExchangeRateService::timeSeries($base, $targets, $startDate, $endDate);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Psr\Http\Client\ClientExceptionInterface $e) {
    throw $e;
}
```

The return value is an instance of `\Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRateInterface` object.

## Switching Provider

Switch between available providers

```php
$exchangeRateService = \ExchangeRateService::provider('free_currency_converter_api');
```

## Caveat

This package will run validation based on respective provider rules before dispatching some requests,
therefore it will throw `\Illuminate\Validation\ValidationException` for every unmet validation rules.

## License

The Laravel Exchange Rate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-packagist]: https://img.shields.io/packagist/v/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate.svg?branch=master&style=flat-square
[ico-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate/branch/master/graph/badge.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-code-of-conduct]: https://img.shields.io/badge/Contributor%20Covenant-v2.0%20adopted-ff69b4.svg

[link-packagist]: https://packagist.org/packages/yoelpc4/laravel-exchange-rate
[link-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate
[link-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate
