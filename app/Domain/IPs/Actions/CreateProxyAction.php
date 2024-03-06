<?php

namespace App\Domain\IPs\Actions;

use App\Domain\IPs\ExternalApies\IpApi\IpApiClient;
use App\Domain\IPs\Jobs\ProxyInfoJob;
use App\Domain\IPs\Models\Proxy;
use Illuminate\Support\Arr;

class CreateProxyAction
{
    public function execute(array $fields): Proxy
    {
        [$ip, $port] = explode(':', $fields['ip_host']);
        $fields['ip'] = $ip;
        $fields['port'] = $port;

//        $existProxy = Proxy::query()
//            ->where('ip', $ip)
//            ->where('port', $port)
//            ->exists();
//
//        if ($existProxy) {
//            return;
//        }

        $proxy = new Proxy();
        $proxy->fill(Arr::only($fields, Proxy::FILLABLE));
        $proxy->save();

        ProxyInfoJob::dispatch($proxy);

        return $proxy;
    }
}
