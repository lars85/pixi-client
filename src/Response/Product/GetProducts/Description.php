<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Product\GetProducts;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class Description
{
    public const VENDOR_ORDER_UNIT_KEY = 'Bestelleinheit beim Lieferanten';

    public const ORDER_BUNDLE_ITEM_KEY = 'Als Bundle (Gartenhaus) beim Lieferanten bestellen';

    /** @var string */
    private $vendorOrderUnit = 'Stueck';

    /** @var bool */
    private $orderBundleItem = false;

    private function __construct()
    {
    }

    public static function create(?string $text): self
    {
        $model = new self();

        $text = trim($text);
        if (empty($text)) {
            return $model;
        }

        try {
            $items = Yaml::parse($text);
        } catch (ParseException $exception) {
            return $model;
        }

        if (!empty($items[self::VENDOR_ORDER_UNIT_KEY])) {
            $model->vendorOrderUnit = $items[self::VENDOR_ORDER_UNIT_KEY];
        }
        if (!empty($items[self::ORDER_BUNDLE_ITEM_KEY])) {
            $model->orderBundleItem = strtolower($items[self::ORDER_BUNDLE_ITEM_KEY]) === 'ja';
        }

        return $model;
    }

    public function getVendorOrderUnit(): string
    {
        return $this->vendorOrderUnit;
    }

    public function isOrderBundleItem(): bool
    {
        return $this->orderBundleItem;
    }
}
