<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\General\GetCountries;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Country[] getIterator()
 * @method Country|null offsetGet()
 * @method Country|null getFirst()
 * @method Country|null getLast()()
 */
class Countries extends Collection
{
    public static function getItemClassName(): string
    {
        return Country::class;
    }

    /**
     * @param Country $item
     * @return string
     */
    protected static function getItemKey($item)
    {
        return $item->getCode();
    }
}