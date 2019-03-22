<?php

declare(strict_types = 1);

namespace Koempf\PixiClient;

interface PixiClientInterface
{
    public function stock(): Api\Stock;

    public function product(): Api\Product;

    public function order(): Api\Order;

    public function general(): Api\General;
}