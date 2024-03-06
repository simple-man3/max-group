<?php

namespace App\Domain\IPs\Jobs;

use App\Domain\IPs\ExternalApies\IpApi\IpApiClient;
use App\Domain\IPs\Jobs\Handler\ProxyInfoHandler;
use App\Domain\IPs\Models\Proxy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProxyInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        readonly protected Proxy $proxy
    ) {
    }

    public function handle(ProxyInfoHandler $handler): void
    {
        $handler->handle($this->proxy);
    }
}
