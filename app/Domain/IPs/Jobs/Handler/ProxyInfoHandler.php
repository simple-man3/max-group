<?php

namespace App\Domain\IPs\Jobs\Handler;

use App\Domain\IPs\ExternalApies\IpApi\IpApiClient;
use App\Domain\IPs\ExternalApies\Proxy\Data\ProxyRequestDto;
use App\Domain\IPs\ExternalApies\Proxy\ProxyApi;
use App\Domain\IPs\Models\Proxy;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class ProxyInfoHandler
{
    private const HTTP_PREFIX = [
        'http' => 'http://',
        'https' => 'https://',
    ];

    public function __construct(
        readonly protected IpApiClient $ipApiClient,
        readonly protected ProxyApi    $proxyApi,
        private array                  $resultProxyInfo = []
    )
    {
    }

    public function handle(Proxy $proxy): void
    {
        $this->setProxyLocation($proxy);
        $this->setProxyType($proxy);
        $this->updateDataProxy($proxy);
        dd('end');
    }

    private function setProxyLocation(Proxy $proxy): void
    {
        try {
            $this->resultProxyInfo = $this->ipApiClient->getProxyLocation($proxy->ip)->toArray();
            $this->resultProxyInfo['is_working'] = true;
        } catch (GuzzleException) {
            $this->resultProxyInfo['is_working'] = false;
        }
    }

    private function setProxyType(Proxy $proxy): void
    {
        $proxyRequest = new ProxyRequestDto([
            'proxy' => [
                'http' => self::HTTP_PREFIX['http'] . "{$proxy->ip}:{$proxy->port}"
            ]
        ]);

        try {
            $this->proxyApi->checkProxyType($proxyRequest);
            $this->resultProxyInfo['type'] = 'http';
        } catch (GuzzleException) {
            $this->resultProxyInfo['type'] = 'socks5';
        }
    }

    private function updateDataProxy(Proxy $proxy)
    {
        /**
         * toDo
         *  [] - необходимо описать логику изменения прокси записи исходя из полученных данных
         */
    }
}
