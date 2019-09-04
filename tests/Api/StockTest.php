<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Api;

use Koempf\PixiClient\Param\ItemFilter;
use Koempf\PixiClient\Response\Stock\GetChangedStockItems\Items;
use Koempf\PixiClient\Response\Stock\GetChangedStockItems\Item;

class StockTest extends TestCase
{
    public function testChangedStockItems()
    {
        $startDate = new \DateTime('- 10 days', new \DateTimeZone('Europe/Berlin'));
        $stockItems = $this->getPixiClient()->stock()->getChangedStockItems($startDate, null, 10);

        $this->assertCount(10, $stockItems);
        $this->assertInstanceOf(Items::class, $stockItems);
        $this->assertIsIterable($stockItems);

        foreach ($stockItems as $stockItem) {
            $this->assertInstanceOf(Item::class, $stockItem);
            $this->assertNotEmpty($stockItem->getId());
            $this->assertNotEmpty($stockItem->getSku());
            $this->assertGreaterThanOrEqual($startDate, $stockItem->getUpdateDate());
        }
    }

    public function testChangedStockItem()
    {
        $startDate = new \DateTime('- 10 days', new \DateTimeZone('Europe/Berlin'));
        $stockItems = $this->getPixiClient()->stock()->getChangedStockItems($startDate, null, 1);

        $this->assertCount(1, $stockItems);
        $this->assertInstanceOf(Items::class, $stockItems);
        $this->assertIsIterable($stockItems);
    }

    public function testEmptyChangedStockItem()
    {
        $startDate = new \DateTime('+ 1 days', new \DateTimeZone('Europe/Berlin'));
        $stockItems = $this->getPixiClient()->stock()->getChangedStockItems($startDate, null, 10);

        $this->assertCount(0, $stockItems);
        $this->assertInstanceOf(Items::class, $stockItems);
        $this->assertIsIterable($stockItems);
    }

    public function testStockItems()
    {
        $stockItems = $this->getPixiClient()->stock()->getStockItems(ItemFilter::create()->addSku('368180'));

        $this->assertSame('368180', $stockItems->getFirst()->getSku());
        $this->assertNotEmpty($stockItems->getFirst()->getGtin());
        $this->assertGreaterThan(200, $stockItems->getFirst()->getCost());
    }

    public function testStockBins()
    {
        $sku = '368180';
        $bins = $this->getPixiClient()->stock()->getItemBins(ItemFilter::create()->addSku($sku));

        $this->assertGreaterThanOrEqual(1, count($bins));
        $this->assertEquals($sku, $bins->getFirst()->getSku());
        $this->assertNotEmpty($bins->getFirst()->getGtin());
        $this->assertNotEmpty($bins->getFirst()->getName());
        $this->assertNotEmpty($bins->getFirst()->getSortNum());
        $this->assertNotEmpty($bins->getFirst()->getLocationId());
    }
}