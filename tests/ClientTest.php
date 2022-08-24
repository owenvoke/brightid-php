<?php

declare(strict_types=1);

use OwenVoke\BrightID\Api\Node;
use OwenVoke\BrightID\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves Node instance
    expect($client->node())->toBeInstanceOf(Node::class);
});

it('allows setting a custom url', function () {
    $client = new Client(null, null, 'https://brightid.test');
    expect($client->getEnterpriseUrl())->toBe('https://brightid.test');
});

it('allows setting a custom api version', function () {
    $client = new Client(null, 'v1');
    expect($client->getApiVersion())->toBe('v1');
});
