<?php

declare(strict_types=1);

use OwenVoke\BrightID\Api\Group;

beforeEach(fn () => $this->apiClass = Group::class);

it('should get information about a specific app', function () {
    $expectedArray = [
        'data' => [
            'id' => 'vPnG-pkagkpLDGgIaFf4adadawdfimR4rTrbnI2r2135aq2w4',
            'members' => [
                '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
            ],
            'invites' => [],
            'admins' => [
                '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
            ],
            'seed' => false,
            'region' => 'Somewhere',
            'type' => 'general',
            'url' => '...',
            'info' => '...',
            'timestamp' => 1555555555,
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/groups/gitcoin')
        ->willReturn($expectedArray);

    /** @var Group $api */
    expect($api->show('gitcoin'))->toBe($expectedArray);
});
