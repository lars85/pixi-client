<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetExtendedBundleItems;

class BundleItem
{
    /** @var int */
    private $id;
    /** @var int */
    private $qty;
    /** @var string */
    private $sku;
    /** @var string */
    private $gtin;
    /** @var string */
    private $vendorNumber;
    /** @var string */
    private $name;
    /** @var float */
    private $price;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = (int)$result->BundleItemKey;
        $model->qty = (int)$result->Qty;
        $model->sku = $result->ItemNrInt;
        $model->gtin = $result->EANUPC;
        $model->vendorNumber = $result->ItemNrSuppl;
        $model->name = $result->ItemName;
        $model->price = (float)$result->Price;

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQty(): int
    {
        return $this->qty;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
