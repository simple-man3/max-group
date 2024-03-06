<?php

namespace App\Domain\IPs\ExternalApies\Proxy;

use App\Domain\IPs\ExternalApies\Proxy\Data\ProxyRequestDto;
use App\Domain\Support\Apis\BaseApi;
use App\Domain\Support\Apis\Configuration;
use App\Domain\Support\Apis\RequestBuilder;
use GuzzleHttp\ClientInterface;

class ProxyApi extends BaseApi
{
    public function __construct(?ClientInterface $client = null, ?Configuration $config = null)
    {
        parent::__construct($client, $config);
    }

    public function checkProxyType(ProxyRequestDto $requestDto)
    {
        $this->send(
            $this->getProxyRequest($requestDto),
            fn () => null
        );
    }

    protected function getProxyRequest(ProxyRequestDto $requestDto): RequestBuilder
    {
        return (new RequestBuilder("/", 'GET'))
            ->json($requestDto);
    }
}
