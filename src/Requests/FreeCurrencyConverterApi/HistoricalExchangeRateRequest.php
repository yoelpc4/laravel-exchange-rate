<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalExchangeRateRequest as HistoricalExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\MustValidated;

class HistoricalExchangeRateRequest extends Request implements HistoricalExchangeRateRequestContract, MustValidated
{
    use Util;

    /**
     * @var string
     */
    public $base;

    /**
     * @var array
     */
    public $symbols;

    /**
     * @var string
     */
    public $date;

    /**
     * HistoricalExchangeRateRequest constructor.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     */
    public function __construct(string $base, $symbols, string $date)
    {
        parent::__construct();

        $this->base = $base;

        $this->symbols = $symbols;

        $this->date = $date;
    }

    /**
     * @inheritDoc
     */
    public function method()
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function uri()
    {
        return 'convert';
    }

    /**
     * @inheritDoc
     */
    public function options()
    {
        return [
            'query' => [
                'apiKey'  => $this->apiKey,
                'q'       => $this->makeQuery(),
                'date'    => $this->date,
                'compact' => 'ultra',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return [
            'base'    => $this->base,
            'symbols' => $this->symbols,
            'date'    => $this->date,
        ];
    }

    /**
     * @inheritDoc
     * @see https://free.currencyconverterapi.com/
     * @referencedAt 2020-01-24
     */
    public function rules()
    {
        $aYearAgo = now()->subYear()->subDay()->toDateString();

        return [
            'base'      => 'required|string|size:3',
            'symbols'   => 'required|array|min:1|between:1,2',
            'symbols.*' => 'required|string|size:3',
            'date'      => "required|string|date|date_format:Y-m-d|after:{$aYearAgo}|before:tomorrow",
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages()
    {
        return [
            'date.after'  => \Lang::get('laravel-exchange-rate::validation.custom.a_year_ago', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
            ]),
            'date.before' => \Lang::get('validation.before', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
                'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.tomorrow'),
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public function customAttributes()
    {
        return [
            'base'      => \Lang::get('laravel-exchange-rate::validation.attributes.base'),
            'symbols'   => \Lang::get('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*' => \Lang::get('laravel-exchange-rate::validation.attributes.symbol'),
            'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @inheritDoc
     */
    public function symbols()
    {
        return $this->symbols;
    }

    /**
     * @inheritDoc
     */
    public function date()
    {
        return $this->date;
    }
}
