<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

use Koempf\PixiClient\Response\Collection;

/**
 * @method static self create(array $results)
 * @method Invoice[] getIterator()
 * @method Invoice|null offsetGet()
 * @method Invoice|null getFirst()
 * @method Invoice|null getLast()()
 */
class Invoices extends Collection
{
    public static function getItemClassName(): string
    {
        return Invoice::class;
    }
}