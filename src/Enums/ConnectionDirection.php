<?php

declare(strict_types=1);

namespace OwenVoke\BrightID\Enums;

enum ConnectionDirection: string
{
    case INBOUND = 'inbound';
    case OUTBOUND = 'outbound';
}
