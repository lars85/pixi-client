<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

use Koempf\PixiClient\Helper;

class Item
{
    /** @var int */
    private $id;
    /** @var string */
    private $idByShop;
    /** @var string */
    private $status;
    /** @var string */
    private $vendor;
    /** @var string */
    private $sku;
    /** @var string */
    private $gtin;
    /** @var string */
    private $name;
    /** @var int */
    private $qty;
    /** @var float */
    private $price;
    /** @var float */
    private $priceInOrderCurrency;
    /** @var float */
    private $fullPrice;
    /** @var string */
    private $currency;
    /** @var float */
    private $shippingCost;
    /** @var float */
    private $shippingCostInOrderCurrency;
    /** @var float */
    private $discount;
    /** @var float */
    private $discountPercent;
    /** @var \DateTime */
    private $createDate;
    /** @var \DateTime */
    private $updateDate;
    /** @var string */
    private $createdBy;
    /** @var string */
    private $updatedBy;
    /** @var string */
    private $locationId;
    /** @var string|null */
    private $dfType;
    /** @var \DateTime|null */
    private $shippedDate;
    /** @var float */
    private $taxesPercent;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = (int)$result->OrderlineKey;
        $model->idByShop = $result->LineItemIDShop;
        $model->status = $result->Status;
        $model->vendor = $result->SupplInfo;
        $model->sku = $result->ItemNrInt;
        $model->gtin = $result->ArtNr;
        $model->name = $result->ArtName;
        $model->qty = (int)$result->Qty;
        $model->price = (float)$result->Price;
        $model->priceInOrderCurrency = (float)$result->Price_OrderCurr;
        $model->fullPrice = (float)$result->FullPrice;
        $model->currency = $result->OrderCurrency;
        $model->shippingCost = (float)$result->ShipCost;
        $model->shippingCostInOrderCurrency = (float)$result->ShipCost_OrderCurr;
        $model->discount = (float)$result->DiscountValue;
        $model->discountPercent = (float)$result->DiscountPerc;
        $model->createDate = Helper::createDateTime($result->CreateDate);
        $model->updateDate = Helper::createDateTime($result->UpdateDate);
        $model->createdBy = $result->CreateEmp;
        $model->updatedBy = $result->UpdateEmp;
        $model->locationId = $result->LocationID;
        $model->dfType = $result->DF_type ?? null;
        $model->shippedDate = Helper::createDateTime($result->DFShipDate ?? '');
        $model->taxesPercent = ((float)$result->VATPercent) * 100.0;

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdByShop(): string
    {
        return $this->idByShop;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceInOrderCurrency(): float
    {
        return $this->priceInOrderCurrency;
    }

    public function getFullPrice(): float
    {
        return $this->fullPrice;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    public function getShippingCostInOrderCurrency(): float
    {
        return $this->shippingCostInOrderCurrency;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getDiscountPercent(): float
    {
        return $this->discountPercent;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): string
    {
        return $this->updatedBy;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function getDfType(): ?string
    {
        return $this->dfType;
    }

    public function getShippedDate(): ?\DateTime
    {
        return $this->shippedDate;
    }

    public function getTaxesPercent(): float
    {
        return $this->taxesPercent;
    }
}
