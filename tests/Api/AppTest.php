<?php

declare(strict_types=1);

use OwenVoke\BrightID\Api\App;

beforeEach(fn () => $this->apiClass = App::class);

it('should get all apps', function () {
    $expectedArray = [
        'data' => [
            'apps' => [
                [
                    'id' => 'gitcoin',
                    'name' => 'Gitcoin',
                    // ...
                ],
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/apps')
        ->willReturn($expectedArray);

    /** @var App $api */
    expect($api->all())->toBe($expectedArray);
});

it('should get information about a specific app', function () {
    $expectedArray = [
        'data' => [
            'id' => 'gitcoin',
            'name' => 'Gitcoin',
            // ...
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/apps/gitcoin')
        ->willReturn($expectedArray);

    /** @var App $api */
    expect($api->show('gitcoin'))->toBe($expectedArray);
});
