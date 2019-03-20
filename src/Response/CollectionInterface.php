<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response;

interface CollectionInterface extends \IteratorAggregate, \Countable, \ArrayAccess
{
    public static function getItemClassName(): string;

    public function getFirst();

    public function getLast();
}