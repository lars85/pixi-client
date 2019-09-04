<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetProducts;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Product[] getIterator()
 * @method Product|null offsetGet()
 * @method Product|null getFirst()
 * @method Product|null getLast()
 */
class Products extends Collection
{
    public static function getItemClassName(): string
    {
        return Product::class;
    }
}
