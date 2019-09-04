<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Stock\GetStockItems;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Item[] getIterator()
 * @method Item|null offsetGet()
 * @method Item|null getFirst()
 * @method Item|null getLast()
 */
class Items extends Collection
{
    public static function getItemClassName(): string
    {
        return Item::class;
    }
}
