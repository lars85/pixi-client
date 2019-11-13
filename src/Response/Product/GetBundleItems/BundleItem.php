<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetBundleItems;

use Koempf\PixiClient\Helper;

class BundleItem
{
    /** @var int */
    private $mainId;
    /** @var int */
    private $itemId;
    /** @var int */
    private $qty;
    /** @var \DateTime */
    private $createDate;
    /** @var \DateTime */
    private $updateDate;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->mainId = (int)$result->ItemRef;
        $model->itemId = (int)$result->BundleItemRef;
        $model->qty = (int)$result->Qty;
        $model->createDate = Helper::createDateTime($result->CreateDate);
        $model->updateDate = Helper::createDateTime($result->UpdateDate);

        return $model;
    }

    public function getMainId(): int
    {
        return $this->mainId;
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }
}
