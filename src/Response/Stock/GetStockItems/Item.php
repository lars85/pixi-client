<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetStockItems;

class Item
{
    /** @var int */
    private $id;
    /** @var string */
    private $sku;
    /** @var string */
    private $gtin;
    /** @var string */
    private $vendorNumber;
    /** @var int */
    private $physicalStock;
    /** @var int */
    private $physicalStockAllLocations;
    /** @var int */
    private $availableStock;
    /** @var int */
    private $openOrderLinesQty;
    /** @var float */
    private $cost;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();
        $model->id = (int)$result->ItemKey;
        $model->sku = $result->ItemNrInt;
        $model->gtin = $result->EANUPC;
        $model->vendorNumber = $result->ItemNrSuppl;
        $model->physicalStock = (int)$result->PhysicalStock;
        $model->physicalStockAllLocations = (int)$result->PhysicalStockAllLocations;
        $model->availableStock = (int)$result->AvailableStock;
        $model->openOrderLinesQty = (int)$result->OpenOrderlineSum;
        $model->cost = (float)$result->SupplPrice;

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function getVendorNumber(): string
    {
        return $this->vendorNumber;
    }

    public function getPhysicalStock(): int
    {
        return $this->physicalStock;
    }

    public function getPhysicalStockAllLocations(): int
    {
        return $this->physicalStockAllLocations;
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }

    public function getOpenOrderLinesQty(): int
    {
        return $this->openOrderLinesQty;
    }

    public function getCost(): float
    {
        return $this->cost;
    }
}
