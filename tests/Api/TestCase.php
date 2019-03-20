<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Api;

use Koempf\PixiClient\PixiClient;

abstract class TestCase extends \Koempf\PixiClient\Tests\TestCase
{
    /** @var PixiClient */
    private $pixiClient;

    protected function getPixiClient(): PixiClient
    {
        if ($this->pixiClient === null) {
            $this->pixiClient = new PixiClient(
                getenv('KOEMPF_PIXI_CLIENT_TEST_LOGIN'),
                getenv('KOEMPF_PIXI_CLIENT_TEST_PASSWORD'),
                getenv('KOEMPF_PIXI_CLIENT_TEST_URI')
            );
        }
        return $this->pixiClient;
    }
}
