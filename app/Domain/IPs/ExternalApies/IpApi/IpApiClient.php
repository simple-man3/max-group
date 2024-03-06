<?php

namespace App\Domain\IPs\ExternalApies\IpApi;

use App\Domain\IPs\ExternalApies\IpApi\Data\IpLocationResponse;
use App\Domain\Support\Apis\BaseApi;
use App\Domain\Support\Apis\Configuration;
use App\Domain\Support\Apis\RequestBuilder;
use App\Exceptions\ApiException;
use GuzzleHttp\ClientInterface;

class IpApiClient extends BaseApi
{
    public function __construct(?ClientInterface $client = null, ?Configuration $config = null)
    {
        parent::__construct($client, $config);
    }

    public function getProxyLocation(string $ip): IpLocationResponse
    {
        return $this->send(
            $this->getProxyLocationRequest($ip),
            fn ($content) => new IpLocationResponse($content)
        );
    }


    protected function getProxyLocationRequest(string $ip): RequestBuilder
    {
        return (new RequestBuilder("/json/{$ip}", 'GET'));
    }
}
