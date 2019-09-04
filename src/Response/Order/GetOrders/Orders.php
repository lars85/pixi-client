<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Order[] getIterator()
 * @method Order|null offsetGet()
 * @method Order|null getFirst()
 * @method Order|null getLast()
 */
class Orders extends Collection
{
    public static function getItemClassName(): string
    {
        return Order::class;
    }
}
