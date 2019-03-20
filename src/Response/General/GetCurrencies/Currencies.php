<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\General\GetCurrencies;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Currency[] getIterator()
 * @method Currency|null offsetGet()
 * @method Currency|null getFirst()
 * @method Currency|null getLast()()
 */
class Currencies extends Collection
{
    public static function getItemClassName(): string
    {
        return Currency::class;
    }

    /**
     * @param Currency $item
     * @return string
     */
    protected static function getItemKey($item)
    {
        return $item->getCode();
    }
}