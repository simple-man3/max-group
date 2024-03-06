<?php

namespace App\Domain\Support\Apis;

class Configuration
{
    private static Configuration $defaultConfiguration;

    /** @var string[] Associate array to store API key(s) */
    protected array $apiKeys = [];

    /** @var string[] Associate array to store API prefix (e.g. Bearer) */
    protected array $apiKeyPrefixes = [];

    /** @var string Access token for OAuth/Bearer authentication */
    protected string $accessToken = '';

    /** @var string Username for HTTP basic authentication */
    protected string $username = '';

    /** @var string Password for HTTP basic authentication */
    protected string $password = '';

    /** @var string The host */
    protected string $host = 'http://localhost/api/v1';

    /** @var string User agent of the HTTP request, set to "Ensi/1.0.0/PHP" by default */
    protected string $userAgent = 'Ensi/1.0.0/PHP';

    public function getApiKey(string $apiKeyIdentifier): ?string
    {
        return $this->apiKeys[$apiKeyIdentifier] ?? null;
    }

    public function getApiKeyPrefix(string $apiKeyIdentifier): ?string
    {
        return $this->apiKeyPrefixes[$apiKeyIdentifier] ?? null;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setHost(string $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function setConfig(string $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public static function getDefaultConfiguration(): Configuration
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }

        return self::$defaultConfiguration;
    }

    public static function setDefaultConfiguration(Configuration $config): void
    {
        self::$defaultConfiguration = $config;
    }

    public function getApiKeyWithPrefix(string $apiKeyIdentifier): ?string
    {
        $prefix = $this->getApiKeyPrefix($apiKeyIdentifier);
        $apiKey = $this->getApiKey($apiKeyIdentifier);

        if ($apiKey === null) {
            return null;
        }

        if ($prefix === null) {
            $keyWithPrefix = $apiKey;
        } else {
            $keyWithPrefix = $prefix . ' ' . $apiKey;
        }

        return $keyWithPrefix;
    }
}
