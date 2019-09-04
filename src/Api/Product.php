<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Param\ItemFilter;
use Koempf\PixiClient\PixiConstants;
use Koempf\PixiClient\Response\Product\GetBundleItems;
use Koempf\PixiClient\Response\Product\GetExtendedBundleItems;
use Koempf\PixiClient\Response\Product\GetProducts\Products;
use Webmozart\Assert\Assert;

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

    // @see http://apps-live.pixi.eu/api-developer-app/index.php/category/2/apicall/389
    public function getExtendedBundleItemsBySku(string $sku): GetExtendedBundleItems\BundleItems
    {
        $results = $this->soapClient->getResults(
            'pixiGetItemBundleDefinition',
            [
                'ItemNrInt' => $sku,
            ]
        );

        return GetExtendedBundleItems\BundleItems::create($results);
    }

    // @see http://apps-live.pixi.eu/api-developer-app/index.php/category/16/apicall/716
    public function getBundleItems(): GetBundleItems\BundleItems
    {
        $results = $this->soapClient->getResults(
            'pixiReadBundleItems',
            [
                'RowCount' => 999999
            ]
        );

        return GetBundleItems\BundleItems::create($results);
    }

    public function addProductXml(int $channel, string $xml, $importImmediately = true): string
    {
        Assert::oneOf($channel, PixiConstants::CHANNELS);

        $importResponse = $this->soapClient->getResponse(
            'pixiImportAddXML',
            [
                'ChannelRef' => $channel,
                'OperationType' => 'item',
                'XML' => $xml,
            ]
        );

        /** @var string $logKey e.g. "383319" */
        $logKey = $importResponse->SqlRowSet[1]->diffgram->SqlRowSet2->row->_x0058_MLKey ?? null;

        if ($importImmediately) {
            $this->soapClient->getResult(
                'pixiImportProcessXML',
                [
                    '_x0058_MLLogKey' => $logKey,
                ]
            );
        }

        return $logKey;
    }
}
