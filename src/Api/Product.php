<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Param\ItemFilter;
use Koempf\PixiClient\Response\Product\GetBundleItems\BundleItems;
use Koempf\PixiClient\Response\Product\GetProducts\Products;

class Product extends AbstractApi
{
    public function getProducts(ItemFilter $filter): Products
    {
        $results = $this->soapClient->getResults(
            'pixiGetItemInfo',
            [
                'ItemXML' => $filter->__toXml(),
            ]
        );

        return Products::create($results);
    }

    // http://apps-live.pixi.eu/api-developer-app/index.php/category/2/apicall/389
    public function getBundleItemsBySku(string $sku): BundleItems
    {
        $results = $this->soapClient->getResults(
            'pixiGetItemBundleDefinition',
            [
                'ItemNrInt' => $sku,
            ]
        );

        return BundleItems::create($results);
    }
}
