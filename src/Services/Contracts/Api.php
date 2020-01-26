<?php

namespace Yoelpc4\LaravelExchangeRate\Services\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Request;

interface Api
{
    /**
     * Perform get request to the specified endpoint
     *
     * @param  Request  $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(Request $request);
}