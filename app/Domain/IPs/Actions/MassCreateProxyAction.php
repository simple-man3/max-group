<?php

namespace App\Domain\IPs\Actions;

use Carbon\Carbon;

class MassCreateProxyAction
{
    public function __construct(
        readonly CreateProxyAction $proxyAction
    )
    {
    }

    public function execute(array $fields): string
    {
        /**
         * toDo
         *  [] - переработать логику вывода хеша на фронт
         */
        $hash = md5(Carbon::now()->timestamp);
        foreach ($fields as $item) {
            $this->proxyAction->execute([
                'ip_host' => $item,
                'hash' => $hash
            ]);
        }

        return $hash;
    }
}
