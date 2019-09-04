<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetExtendedBundleItems;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method BundleItem[] getIterator()
 * @method BundleItem|null offsetGet()
 * @method BundleItem|null getFirst()
 * @method BundleItem|null getLast()
 */
class BundleItems extends Collection
{
    public static function getItemClassName(): string
    {
        return BundleItem::class;
    }

    /**
     * @param BundleItem $item
     * @return string
     */
    protected static function getItemKey($item)
    {
        return $item->getSku();
    }
}
