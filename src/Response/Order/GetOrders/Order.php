<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

class Order
{
    /** @var int */
    private $id;
    /** @var string */
    private $orderReference;
    /** @var string */
    private $status;
    /** @var Address */
    private $billingAddress;
    /** @var Address */
    private $shippingAddress;
    /** @var Customer */
    private $customer;
    /** @var string */
    private $shippingVendor;
    /** @var float */
    private $discount;
    /** @var \DateTime */
    private $createDate;
    /** @var |DateTime */
    private $updateDate;
    /** @var string */
    private $updatedBy;
    /** @var string */
    private $channelReference;
    /** @var bool */
    private $looked;
    /** @var string */
    private $shopNote;
    /** @var float */
    private $subTotal;
    /** @var float */
    private $total;
    /** @var string */
    private $type;
    /** @var string */
    private $pickList;
    /** @var Items */
    private $items;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = (int)$result->OrderNr;
        $model->orderReference = $result->OrderNrExternal;
        $model->status = $result->OrderStatus;
        $model->billingAddress = Address::create($result->BillingAddress->row);
        $model->shippingAddress = Address::create($result->ShippingAddress->row);
        $model->customer = Customer::create($result->Customer->row);
        $model->shippingVendor = $result->OrderShippingVendor;
        $model->discount = (float)$result->Discount;
        $model->createDate = new \DateTime($result->CreateDate);
        $model->updateDate = new \DateTime($result->UpdateDate);
        $model->updatedBy = $result->UpdateEmp;
        $model->channelReference = $result->ChannelRef;
        $model->looked = $result->OhSLocked !== 'N';
        $model->shopNote = trim($result->Shop_Note);
        $model->subTotal = (float)$result->OrderLinesTotal;
        $model->total = (float)$result->OrderTotal;
        $model->type = $result->OrderType;
        $model->pickList = $result->OnPicklist;

        $model->items = Items::create(
            is_array($result->OrderLines->row)
                ? $result->OrderLines->row
                : [$result->OrderLines->row]
        );

        $model->items = Items::create(
            is_array($result->OrderLines->row)
                ? $result->OrderLines->row
                : [$result->OrderLines->row]
        );

        return $model;
    }

    public function isB2C(): bool
    {
        return $this->getType() === 'B2C';
    }

    public function istB2B(): bool
    {
        return $this->getType() === 'B2B';
    }
}
