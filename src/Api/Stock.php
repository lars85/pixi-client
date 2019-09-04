<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Param\ItemFilter;
use Koempf\PixiClient\Response\Stock\GetChangedStockItems;
use Koempf\PixiClient\Response\Stock\GetItemBins\Bins;
use Koempf\PixiClient\Response\Stock\GetStockItems;

class Stock extends AbstractApi
{
    // @see http://apps-live.pixi.eu/api-developer-app/index.php/category/2/apicall/441
    public function getChangedStockItems(
        \DateTime $startDate,
        ?\DateTime $endDate = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $locationId = null
    ): GetChangedStockItems\Items {

        $results = $this->soapClient->getResultsWithPagination(
            'pixiGetChangedItemStock',
            [
                'Since' => $this->__getFormattedDateTime($startDate),
                'Rowcount' => $limit,
                'LocID' => $locationId,
                'DateTo' => $endDate ? $this->__getFormattedDateTime($endDate) : null,
                'Start' => $offset,
            ]
        );

        return GetChangedStockItems\Items::create($results);
    }

    // @see http://apps-live.pixi.eu/api-developer-app/index.php/category/2/apicall/50
    public function getStockItems(ItemFilter $filter): GetStockItems\Items
    {
        $results = $this->soapClient->getResults(
            'pixiGetItemStock',
            [
                'ItemXML' => $filter->__toXml()
            ]
        );

        return GetStockItems\Items::create($results);
    }

    public function getItemBins(ItemFilter $filter): Bins
    {
        $results = $this->soapClient->getResults(
            'pixiGetItemStockBins',
            [
                'ItemXML' => $filter->__toXml()
            ]
        );

        return Bins::create($results);
    }
}
