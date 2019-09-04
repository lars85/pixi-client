<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Api;

use Koempf\PixiClient\Param\ItemFilter;

class ProductTest extends TestCase
{
    public function testInfo()
    {
        $products = $this->getPixiClient()->product()->getProducts(ItemFilter::create()->addSku('368180'));

        $this->assertCount(1, $products);
        $this->assertSame('368180', $products->getFirst()->getSku());
    }

    public function testGetBundleItems()
    {
        $bundleItems = $this->getPixiClient()->product()->getBundleItems();

        $firstBundleItem = $bundleItems->getFirst();
        $this->assertIsInt($firstBundleItem->getMainId());
        $this->assertIsInt($firstBundleItem->getItemId());
        $this->assertIsInt($firstBundleItem->getQty());
    }

    public function testGetBundleItemsExtended()
    {
        $bundleItems = $this->getPixiClient()->product()->getExtendedBundleItemsBySku('51583');

        $this->assertGreaterThan(3, $bundleItems->count());

        $firstBundleItem = $bundleItems->getFirst();
        $this->assertIsInt($firstBundleItem->getId());
        $this->assertNotEmpty($firstBundleItem->getId());
        $this->assertNotEmpty($firstBundleItem->getSku());
        $this->assertNotEmpty($firstBundleItem->getGtin());
        $this->assertNotEmpty($firstBundleItem->getName());
        $this->assertNotEmpty($firstBundleItem->getQty());
    }
}
