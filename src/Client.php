<?php

declare(strict_types=1);

namespace OwenVoke\BrightID;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use OwenVoke\BrightID\Api\AbstractApi;
use OwenVoke\BrightID\Api\App;
use OwenVoke\BrightID\Api\Node;
use OwenVoke\BrightID\Api\User;
use OwenVoke\BrightID\Exception\BadMethodCallException;
use OwenVoke\BrightID\Exception\InvalidArgumentException;
use OwenVoke\BrightID\HttpClient\Builder;
use OwenVoke\BrightID\HttpClient\Plugin\PathPrepend;
use Psr\Http\Client\ClientInterface;

/**
 * @method App app()
 * @method App apps()
 * @method Node node()
 * @method User user()
 * @method User users()
 */
final class Client
{
    public function __construct(
        private Builder|null $httpClientBuilder = null,
        private string|null $apiVersion = null,
        private string|null $enterpriseUrl = null
    ) {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://app.brightid.org')));
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'brightid-php (https://github.com/owenvoke/brightid-php)',
        ]));

        $this->apiVersion = $apiVersion ?: 'v6';
        $builder->addHeaderValue('Accept', 'application/json');
        $builder->addPlugin(new PathPrepend(sprintf('/node/%s', $this->getApiVersion())));

        if ($enterpriseUrl) {
            $this->setEnterpriseUrl($enterpriseUrl);
        }
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'app', 'apps' => new App($this),
            'node' => new Node($this),
            'user', 'users' => new User($this),
            default => throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name)),
        };
    }

    private function setEnterpriseUrl(string $enterpriseUrl): void
    {
        $this->enterpriseUrl = $enterpriseUrl;

        $builder = $this->getHttpClientBuilder();
        $builder->removePlugin(AddHostPlugin::class);
        $builder->removePlugin(PathPrepend::class);

        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($this->getEnterpriseUrl())));
        $builder->addPlugin(new PathPrepend(sprintf('/node/%s', $this->getApiVersion())));
    }

    public function getEnterpriseUrl(): ?string
    {
        return $this->enterpriseUrl;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name), $e->getCode(), $e);
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
