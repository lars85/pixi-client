<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Helper;
use Koempf\PixiClient\PixiConstants;
use Koempf\PixiClient\Response\Order\GetOrders\Orders;
use Webmozart\Assert\Assert;

class Order extends AbstractApi
{
    public const CHANNEL_SPRYKER = 7;

    public function getOrdersByIds(array $ids): Orders
    {
        Assert::allInteger($ids);
        Assert::notEmpty($ids);

        $results = $this->soapClient->getResults(
            'pixiGetOrder',
            [
                'OrderNrXML' => Helper::arrayToXml(['OrderNr' => $ids], 'OrderNrs'),
            ]
        );

        return Orders::create($results);
    }

    public function getOrderById(int $id)
    {
        return $this->getOrdersByIds([$id])->getFirst();
    }

    public function getOrdersByReferenceIds(array $referenceIds): Orders
    {
        Assert::allString($referenceIds);
        Assert::notEmpty($referenceIds);

        $results = $this->soapClient->getResults(
            'pixiGetOrder',
            [
                'OrderNrXML' => Helper::arrayToXml(['OrderNrExternal' => $referenceIds], 'OrderNrs'),
            ]
        );

        return Orders::create($results);
    }

    public function getOrdersByReferenceId(int $referenceId)
    {
        return $this->getOrdersByReferenceIds([$referenceId])->getFirst();
    }

    public function addOrderXml(int $channel, string $xml, $importImmediately = true): string
    {
        Assert::oneOf($channel, PixiConstants::CHANNELS);

        $importResponse = $this->soapClient->getResponse(
            'pixiImportAddXML',
            [
                'ChannelRef' => $channel,
                'OperationType' => 'ORDER',
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
