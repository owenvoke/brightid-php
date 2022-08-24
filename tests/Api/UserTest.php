<?php

declare(strict_types=1);

use OwenVoke\BrightID\Api\User;
use OwenVoke\BrightID\Enums\ConnectionDirection;

beforeEach(fn () => $this->apiClass = User::class);

it('should get a users profile', function () {
    $expectedArray = [
        'data' => [
            'id' => '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
            'sponsored' => true,
            'verifications' => [],
            'recoveryConnections' => [],
            'connectionsNum' => 1,
            'groupsNum' => 0,
            'reports' => [],
            'createdAt' => 1555555555,
            'signingKeys' => [
                '...',
            ],
            'requiredRecoveryNum' => 2,
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/profile')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->profile('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users profile as a requester', function () {
    $expectedArray = [
        'data' => [
            'id' => '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
            'sponsored' => true,
            'verifications' => [],
            'recoveryConnections' => [],
            'connectionsNum' => 1,
            'groupsNum' => 0,
            'reports' => [],
            'createdAt' => 1555555555,
            'signingKeys' => [
                '...',
            ],
            'requiredRecoveryNum' => 2,
            'mutualConnections' => [],
            'mutualGroups' => [],
            'connectedAt' => 1555555555,
            'level' => 'just met',
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/profile/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->profileAs(
        '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
        '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
    ))->toBe($expectedArray);
});

it('should get a users memberships', function () {
    $expectedArray = [
        'data' => [
            'memberships' => [
                [
                    'id' => 'i-xzfE4GHD86DDWA2rdAWD5tWYYapxnw0DVDT2e4rqradDqdxZ',
                    'timestamp' => 1555555555,
                ],
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/memberships')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->memberships('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users invites', function () {
    $expectedArray = [
        'data' => [
            'invites' => [],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/invites')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->invites('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users verifications', function () {
    $expectedArray = [
        'data' => [
            'verifications' => [
                'name' => 'BrightID',
                'block' => 123456,
                'timestamp' => 1555555555,
                'hash' => 'a9fdahf929r21rt92q1rtq-adad',
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/verifications')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->verifications('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users connections', function (ConnectionDirection $direction) {
    $expectedArray = [
        'data' => [
            'connections' => [
                [
                    'id' => '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
                    'level' => 'just met',
                    'reportReason' => null,
                    'timestamp' => 1555555555,
                ],
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with("/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/connections/{$direction->value}")
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->connections('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx', $direction))->toBe($expectedArray);
})->with([
    'inbound' => [ConnectionDirection::INBOUND],
    'outbound' => [ConnectionDirection::OUTBOUND],
]);

it('should get a users inbound connections', function () {
    $expectedArray = [
        'data' => [
            'connections' => [
                [
                    'id' => '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
                    'level' => 'just met',
                    'reportReason' => null,
                    'timestamp' => 1555555555,
                ],
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/connections/inbound')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->inboundConnections('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users outbound connections', function () {
    $expectedArray = [
        'data' => [
            'connections' => [
                [
                    'id' => '_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx',
                    'level' => 'just met',
                    'reportReason' => null,
                    'timestamp' => 1555555555,
                ],
            ],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/connections/outbound')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->outboundConnections('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});

it('should get a users family groups', function () {
    $expectedArray = [
        'data' => [
            'connections' => ['_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'],
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx/familiesToVouch')
        ->willReturn($expectedArray);

    /** @var User $api */
    expect($api->familyGroups('_D69MAWD2421UiWPXF4eJD_y0EBMhawdfaf25t1AWDDl5amnx'))->toBe($expectedArray);
});
