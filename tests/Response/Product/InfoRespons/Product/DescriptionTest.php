<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Response\Product\InfoResponse\Product;

use Koempf\PixiClient\Response\Product\GetProducts\Description;
use Koempf\PixiClient\Tests\TestCase;

class DescriptionTest extends TestCase
{
    public function testValidText()
    {
        $yaml = 'Bestelleinheit beim Lieferanten: Mias
Als Bundle (Gartenhaus) beim Lieferanten bestellen: Ja';

        $description = Description::create($yaml);

        $this->assertSame(true, $description->isOrderBundleItem());
        $this->assertSame('Mias', $description->getVendorOrderUnit());
    }
}
