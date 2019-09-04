<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetItemBins;

class Bin
{
    /** @var string */
    private $name;

    /** @var int */
    private $qty;

    /** @var int */
    private $sortNum;

    /** @var string */
    private $gtin;

    /** @var string */
    private $sku;

    /** @var string */
    private $locationId;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->name = $result->BinName;
        $model->qty = (int)$result->Quantity;
        $model->sortNum = (int)$result->BinSortNum;
        $model->gtin = $result->EAN;
        $model->sku = $result->ItemNRInt;
        $model->locationId = $result->LocID;

        return $model;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getSortNum(): int
    {
        return $this->sortNum;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }
}
