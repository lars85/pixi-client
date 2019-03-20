<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response;

use Koempf\PixiClient\Response\Exceptions\OnlyReadAccessException;
use Webmozart\Assert\Assert;

abstract class Collection implements CollectionInterface
{
    /** @var array */
    private $items;

    private function __construct()
    {
    }

    public static function create(array $results): self
    {
        $model = new static();
        $model->items = [];

        foreach ($results as $result) {
            $item = call_user_func(static::getItemClassName() . '::create', $result);
            Assert::isInstanceOf($item, static::getItemClassName());
            $key = static::getItemKey($item);
            if ($key !== null) {
                $model->items[$key] = $item;
            } else {
                $model->items[] = $item;
            }
        }

        return $model;
    }

    protected static function getItemKey($item)
    {
        return null;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function sortByPropertyValue(string $property, bool $reverseOrder = false): self
    {
        return $this->sort(function ($a, $b) use ($property, $reverseOrder) {
            $getter = sprintf('get%s', ucfirst($property));
            Assert::methodExists($a, $getter);
            Assert::methodExists($b, $getter);
            $result = strcmp($a->$getter(), $b->$getter());
            return $reverseOrder ? !$result : $result;
        });
    }

    public function sort(callable $compareFunction): self
    {
        uasort($this->items, $compareFunction);
        return $this;
    }

    public function filterByPropertyValue(string $property, $value): self
    {
        return $this->filter(function ($item) use ($property, $value) {
            $getter = sprintf('get%s', ucfirst($property));
            Assert::methodExists($item, $getter);
            return $item->$getter() === $value;
        });
    }

    public function filter(callable $filterFunction): self
    {
        $filteredItems = [];
        foreach ($this->items as $item) {
            if ($filterFunction($item) === true) {
                $filteredItems[] = $item;
            }
        }
        $model = new static();
        $model->items = $filteredItems;
        return $model;
    }

    public function getOneByPropertyValue(string $property, $value)
    {
        foreach ($this->items as $item) {
            $getter = sprintf('get%s', ucfirst($property));
            Assert::methodExists($item, $getter);
            if ($item->$getter() === $value) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        throw new OnlyReadAccessException();
    }

    public function offsetUnset($offset): void
    {
        throw new OnlyReadAccessException();
    }

    public function getFirst()
    {
        return array_values(array_slice($this->items, 0, 1))[0] ?? null;
    }

    public function getLast()
    {
        return array_values(array_slice($this->items, -1, 1))[0] ?? null;
    }
}