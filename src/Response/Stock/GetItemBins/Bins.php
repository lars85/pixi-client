<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetItemBins;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Bin[] getIterator()
 * @method Bin|null offsetGet()
 * @method Bin|null getFirst()
 * @method Bin|null getLast()
 */
class Bins extends Collection
{
    public static function getItemClassName(): string
    {
        return Bin::class;
    }
}
