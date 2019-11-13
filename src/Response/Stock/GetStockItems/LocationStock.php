<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetStockItems;

class LocationStock
{
    const COL_LOCATION_ID = 'locationId';
    const COL_PHYSICAL_QUANTITY = 'physicalQuantity';
    const COL_RESERVED_QUANTITY = 'reservedQuantity';

    /** @var string */
    private $locationId;

    /** @var int */
    private $physicalQuantity;

    /** @var int */
    private $reservedQuantity;

    /** @var int */
    private $availableQuantity;

    public static function create(\stdClass $result): self
    {
        $model = new self();
        $model->locationId = (string) $result->{self::COL_LOCATION_ID};
        $model->physicalQuantity = (int) $result->{self::COL_PHYSICAL_QUANTITY};
        $model->reservedQuantity = (int) $result->{self::COL_RESERVED_QUANTITY};

        $model->availableQuantity = $model->physicalQuantity - $model->reservedQuantity;

        return $model;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function getPhysicalQuantity(): int
    {
        return $this->physicalQuantity;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function getReservedQuantity(): int
    {
        return $this->reservedQuantity;
    }
}