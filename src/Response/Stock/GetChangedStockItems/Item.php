<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetChangedStockItems;

use Koempf\PixiClient\Helper;

class Item
{
    /** @var int */
    private $id;
    /** @var string */
    private $sku;
    /** @var string */
    private $gtin;
    /** @var string|null */
    private $vendorNumber;
    /** @var int */
    private $physicalStock;
    /** @var int */
    private $availableStock;
    /** @var int */
    private $stockChange;
    /** @var int */
    private $minStockQty;
    /** @var bool */
    private $enabled;
    /** @var int */
    private $openSupplierOrderQty;
    /** @var \DateTime */
    private $updateDate;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();
        $model->id = (int)$result->ItemKey;
        $model->sku = $result->ItemNrInt;
        $model->gtin = $result->EANUPC;
        $model->vendorNumber = $result->ItemNrSuppl ?? null;
        $model->physicalStock = (int)$result->PhysicalStock;
        $model->availableStock = (int)$result->AvailableStock;
        $model->stockChange = (int)$result->StockChange;
        $model->minStockQty = (int)$result->MinStockQty;
        $model->enabled = $result->Enabled === '1';
        $model->openSupplierOrderQty = $result->OpenSupplierOrderQTY;
        $model->updateDate = Helper::createDateTime($result->UpdateDate);

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

    public function getVendorNumber(): ?string
    {
        return $this->vendorNumber;
    }

    public function getPhysicalStock(): int
    {
        return $this->physicalStock;
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }

    public function getStockChange(): int
    {
        return $this->stockChange;
    }

    public function getMinStockQty(): int
    {
        return $this->minStockQty;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getOpenSupplierOrderQty(): int
    {
        return $this->openSupplierOrderQty;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }
}
