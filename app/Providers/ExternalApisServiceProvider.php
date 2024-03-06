<?php

namespace App\Providers;

use App\Domain\IPs\ExternalApies\IpApi\IpApiClient;
use App\Domain\IPs\ExternalApies\Proxy\ProxyApi;
use App\Domain\Support\Apis\Configuration;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\ServiceProvider;

class ExternalApisServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(IpApiClient::class)
            ->needs(Configuration::class)
            ->give(fn() => (new Configuration())->setHost(config('external-api.ip-api.host')));

        $this->app->when(ProxyApi::class)
            ->needs(ClientInterface::class)
            ->give(fn() => (new Client([
                RequestOptions::VERIFY => false,
                RequestOptions::TIMEOUT => config('external-api.proxy.timeout'),
            ])));
    }
}
