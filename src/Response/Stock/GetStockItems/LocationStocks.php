<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetStockItems;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method LocationStock[] getIterator()
 * @method LocationStock|null offsetGet()
 * @method LocationStock|null getFirst()
 * @method LocationStock|null getLast()
 */
class LocationStocks extends Collection
{
    public static function getItemClassName(): string
    {
        return LocationStock::class;
    }

    public static function createLocationStocks(\stdClass $result): self
    {
        if (!isset($result->Locations) && !isset($result->OpenOrderlineSumLocations)) {
            return self::create([]);
        }

        $physicalStocks = self::mapLocationStocks($result->Locations ?? '');
        $reservedStocks = self::mapLocationStocks($result->OpenOrderlineSumLocations ?? '');

        $mappedLocationStocks = [];
        foreach ($physicalStocks as $locationIdentifier => $quantity) {
            $mappedLocationStocks[$locationIdentifier] = (object)[
                LocationStock::COL_LOCATION_ID => $locationIdentifier,
                LocationStock::COL_PHYSICAL_QUANTITY => $quantity,
                LocationStock::COL_RESERVED_QUANTITY => $reservedStocks[$locationIdentifier],
            ];
        }

        return self::create($mappedLocationStocks);
    }

    private static function mapLocationStocks(string $unmappedLocationStocks): array
    {
        if (empty($unmappedLocationStocks)) {
            return [];
        }

        $unmappedLocationStocks = preg_split('/\s*;\s*/', trim($unmappedLocationStocks), -1, PREG_SPLIT_NO_EMPTY);

        $mappedLocationStocks = [];
        foreach ($unmappedLocationStocks as $unmappedLocationStock) {
            $data = preg_split('/\s*:\s*/', trim($unmappedLocationStock), -1, PREG_SPLIT_NO_EMPTY);
            if (count($data) !== 2) {
                continue;
            }

            list($locationId, $quantity) = $data;
            $mappedLocationStocks[$locationId] = (int)$quantity;
        }

        return $mappedLocationStocks;
    }
}