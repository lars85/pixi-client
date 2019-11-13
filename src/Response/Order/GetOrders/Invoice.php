<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

use Koempf\PixiClient\Helper;

class Invoice
{
    /** @var int */
    private $id;
    /** @var string */
    private $referenceNumber;
    /** @var \DateTime */
    private $createDate;
    /** @var \DateTime */
    private $dueDate;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = (int)$result->InvoiceKey;
        $model->referenceNumber = $result->InvoiceNr;
        $model->createDate = Helper::createDateTime($result->InvDate);
        $model->dueDate = Helper::createDateTime($result->DueDate);
        $model->highTaxes = (float)$result->VATBaseHigh;
        $model->lowTaxes = (float)$result->VATBaseLow;
        $model->total = (float)$result->Total;
        $model->totalInOrderCurrency = (float)$result->Total_OrderCurr;
        $model->paymentCode = $result->PaymentCode;
        $model->paidDate = Helper::createDateTime($result->PaidDate);
        $model->paidAmount = (float)$result->PaidAmount;
        $model->createDate = Helper::createDateTime($result->CreateDate);
        $model->updateDate = Helper::createDateTime($result->UpdateDate);
        $model->createdBy = $result->CreateEmp;
        $model->updatedBy = $result->UpdateEmp;
        $model->boxNumber = $result->BoxNr;
        $model->shippingCost = (float)$result->Total_ShipCost;
        $model->shippingCostInOrderCurrency = (float)$result->Total_ShipCost_OrderCurr;
        $model->scanOutDate = Helper::createDateTime($result->ScanOutDate);
        $model->currency = $result->OrderCurrency;
        $model->VATBaseHigh_OrderCurr = $result->VATBaseHigh_OrderCurr; // 0.0000
        $model->VATBaseLow_OrderCurr = $result->VATBaseLow_OrderCurr; // 0.0000
        $model->VATBaseHigh_ShipCost = $result->VATBaseHigh_ShipCost; // 0.0000
        $model->VATBaseLow_ShipCost = $result->VATBaseLow_ShipCost; // 0.0000
        $model->VATBaseHigh_ShipCost_OrderCurr = $result->VATBaseHigh_ShipCost_OrderCurr; // 0.0000
        $model->VATBaseLow_ShipCost_OrderCurr = $result->VATBaseLow_ShipCost_OrderCurr; // 0.0000
        $model->VATHigh = $result->VATHigh; // 0.0000
        $model->VATHighPerc = $result->VATHighPerc; // 19.0000
        $model->VATLow = $result->VATLow; // 0.0000
        $model->VATLowPerc = $result->VATLowPerc; // 7.0000
        $model->VATHText = $result->VATHText; // 19.00
        $model->VATLText = $result->VATLText; // 7.00
        $model->AddrRef = $result->AddrRef; // 21008
        $model->ShipAdrRef = $result->ShipAdrRef; // 21009
        $model->InvLocationID = $result->InvLocationID; // 001
        $model->PackageGrossWeight = $result->PackageGrossWeight; // 6.000000000000000e+000
        $model->Locked = $result->Locked; // N
        $model->VoucherSum_OrderCurr = $result->VoucherSum_OrderCurr; // 0.0000
        $model->VATinShipCost = $result->VATinShipCost; // Y
        $model->ShipmentTrackingID = $result->ShipmentTrackingID; // 00340434169153792955
        $model->TrackingIDsent = $result->TrackingIDsent; // 2019-01-31T16:47:00.590

        $model->Is1SS = $result->Is1SS;
        $model->InvoiceLines = $result->InvoiceLines;

        return $model;
    }
}

$blub = '
			[row] => stdClass Object
                (
                    [InvDate] => 2019-01-31T13:35:19.267
                    [VATBaseHigh] => 0.0000
                    [VATBaseLow] => 0.0000
                    [Total] => 0.0000
                    [PaymentCode] => R
                    [PaidDate] => 2019-01-31T13:35:19.267
                    [PaidAmount] => 0.0000
                    [CreateDate] => 2019-01-31T13:35:19.267
                    [CreateEmp] => stw
                    [UpdateDate] => 2019-01-31T16:45:20.793
                    [UpdateEmp] => TrackingID Import
                    [BoxNr] => 28
                    [Total_OrderCurr] => 0.0000
                    [Total_ShipCost] => 0.0000
                    [Total_ShipCost_OrderCurr] => 0.0000
                    [ScanOutDate] => 2019-01-31T13:45:43.090
                    [OrderCurrency] => EUR
                    [VATBaseHigh_OrderCurr] => 0.0000
                    [VATBaseLow_OrderCurr] => 0.0000
                    [VATBaseHigh_ShipCost] => 0.0000
                    [VATBaseLow_ShipCost] => 0.0000
                    [VATBaseHigh_ShipCost_OrderCurr] => 0.0000
                    [VATBaseLow_ShipCost_OrderCurr] => 0.0000
                    [VATHigh] => 0.0000
                    [VATHighPerc] => 19.0000
                    [VATLow] => 0.0000
                    [VATLowPerc] => 7.0000
                    [VATHText] => 19.00
                    [VATLText] => 7.00
                    [AddrRef] => 21008
                    [ShipAdrRef] => 21009
                    [InvLocationID] => 001
                    [PackageGrossWeight] => 6.000000000000000e+000
                    [Locked] => N
                    [VoucherSum_OrderCurr] => 0.0000
                    [VATinShipCost] => Y
                    [ShipmentTrackingID] => 00340434169153792955
                    [TrackingIDsent] => 2019-01-31T16:47:00.590
                    [Is1SS] => 0
                    [InvoiceLines] => stdClass Object
                        (
                            [row] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [InvoiceLineKey] => 4873
                                            [OrderLineRef] => 19736
                                            [ItemNr] => 4004338330996
                                            [ItemQty] => 1
                                            [OrderQty] => 1
                                            [ItemText] => Sturmwinkel/Sturmanker zur Befestigung des Gartenhauses am Fundament (1 Stück)
                                            [ItemPrice] => 0.0000
                                            [ItemPrice_OrderCurr] => 0.0000
                                            [ItemDiscount] => 0
                                            [ItemVAT] => H
                                            [CreateDate] => 2019-01-31T13:35:19.300
                                            [CreateEmp] => SVKOEMPFOS1\SVKOEMPFOS1.8
                                            [ShipCost] => 0.0000
                                            [ShipCost_OrderCurr] => 0.0000
                                            [ItemRef] => 352533
                                            [FullPrice] => 0.0000
                                            [DiscountValue] => 0.0000
                                            [DiscountPerc] => 0.00
                                        )';
