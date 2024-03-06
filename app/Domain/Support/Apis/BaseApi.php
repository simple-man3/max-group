<?php

namespace App\Domain\Support\Apis;

use App\Exceptions\ApiException;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

abstract class BaseApi
{
    protected ClientInterface $client;
    protected Configuration $config;

    public function __construct(?ClientInterface $client = null, ?Configuration $config = null)
    {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
    }

    /**
     * @throws GuzzleException
     * @throws ApiException
     */
    protected function send(RequestBuilder $request, Closure $fn)
    {
        try {
            $response = $this->client->send($request->build($this->config, $this->client));
        } catch (RequestException $e) {
            throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse());
        }

        return $fn($this->deserialize($response));
    }

    protected function deserialize(ResponseInterface $response): mixed
    {
        return json_decode((string)$response->getBody(), true);
    }
}
