<?php

declare(strict_types=1);

namespace Koempf\PixiClient;

interface PixiConstants
{
    public const CHANNEL_AKENEO = 3;
    public const CHANNEL_SPRYKER = 4;
    public const CHANNEL_MAGENTO = 7;
    public const CHANNEL_WEBHOOK = 8;
    public const CHANNEL_CHANNABLE = 9;

    public const CHANNELS = [
        self::CHANNEL_AKENEO,
        self::CHANNEL_SPRYKER,
        self::CHANNEL_MAGENTO,
        self::CHANNEL_WEBHOOK,
        self::CHANNEL_CHANNABLE,
    ];
}