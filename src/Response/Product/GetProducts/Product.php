<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetProducts;

class Product
{
    /** @var int */
    private $id;
    /** @var float */
    private $cost;
    /** @var string */
    private $name;
    /** @var int*/
    private $packagingUnit;
    /** @var int */
    private $orderUnit;
    /** @var int */
    private $minStockQty;
    /** @var int */
    private $minOrderQty;
    /** @var string */
    private $vendor;
    /** @var string */
    private $category;
    /** @var string */
    private $sku;
    /** @var string */
    private $vendorNumber;
    /** @var int */
    private $stockQty;
    /** @var float */
    private $price;
    /** @var string */
    private $taxesLevel;
    /** @var bool */
    private $enabled;
    /** @var string[] */
    private $tags;
    /** @var string */
    private $gtin;
    /** @var string|null */
    private $largePictureUrl;
    /** @var string|null */
    private $smallPictureUrl;
    /** @var string */
    private $internalItemNumber;
    /** @var int */
    private $safetyStock;
    /** @var int */
    private $targetStock;
    /** @var Description */
    private $description;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = $result->ItemKey;
        $model->cost = (float)$result->SupplPrice;
        $model->name = $result->ItemName;
        $model->packagingUnit = (int)$result->VPE;
        $model->orderUnit = (int)$result->OrderUnit;
        $model->minStockQty = (int)$result->MinStockQty;
        $model->minOrderQty = (int)$result->MinOrderQty;
        $model->vendor = $result->SupplNr;
        $model->category = $result->Category;
        $model->sku = $result->ItemNrInt;
        $model->vendorNumber = $result->ItemNrSuppl;
        $model->stockQty = (int)$result->Quantity;
        $model->price = (float)$result->PriceVK;
        $model->taxesLevel = $result->VATLevel;
        $model->enabled = $result->Enabled === '1';
        $model->tags = explode('|', $result->ItemTAGs);
        $model->gtin = $result->EANUPC;
        $model->largePictureUrl = $result->PicLinkLarge ?? null;
        $model->smallPictureUrl = $result->PicLinkSmall ?? null;
        $model->internalItemNumber = $result->InternalItemNumber;
        $model->safetyStock = (int)$result->SafetyStock;
        $model->targetStock = (int)$result->TargetStock;
        $model->description = Description::create($result->ItemDescription);

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPackagingUnit(): int
    {
        return $this->packagingUnit;
    }

    public function getOrderUnit(): int
    {
        return $this->orderUnit;
    }

    public function getMinStockQty(): int
    {
        return $this->minStockQty;
    }

    public function getMinOrderQty(): int
    {
        return $this->minOrderQty;
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getVendorNumber(): string
    {
        return $this->vendorNumber;
    }

    public function getStockQty(): int
    {
        return $this->stockQty;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTaxesLevel(): string
    {
        return $this->taxesLevel;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function getLargePictureUrl(): ?string
    {
        return $this->largePictureUrl;
    }

    public function getSmallPictureUrl(): ?string
    {
        return $this->smallPictureUrl;
    }

    public function getInternalItemNumber(): string
    {
        return $this->internalItemNumber;
    }

    public function getSafetyStock(): int
    {
        return $this->safetyStock;
    }

    public function getTargetStock(): int
    {
        return $this->targetStock;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }
}
