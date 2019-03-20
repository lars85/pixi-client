<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

class Customer
{
    /** @var bool */
    private $locked;
    /** @var string */
    private $paymentCode;
    /** @var string */
    private $shopId;
    /** @var \DateTime */
    private $createDate;
    /** @var \DateTime */
    private $updateDate;
    /** @var string */
    private $createdBy;
    /** @var string */
    private $updatedBy;
    /** @var string */
    private $customerNumber;
    /** @var bool */
    private $taxesOnInvoice;
    /** @var bool */
    private $posCustomer;
    /** @var string */
    private $reminderAction;
    /** @var string */
    private $datevAccountNumber;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->locked = $result->Locked !== 'N';
        $model->paymentCode = $result->PaymentCode;
        $model->shopId = $result->ShopID;
        $model->createDate = new \DateTime($result->CreateDate);
        $model->updateDate = new \DateTime($result->UpdateDate);
        $model->createdBy = $result->CreateEmp;
        $model->updatedBy = $result->UpdateEmp;
        $model->customerNumber = $result->CustomerNrExternal;
        $model->taxesOnInvoice = $result->TaxOnInvoice === 'Y';
        $model->posCustomer = $result->POSCustomer !== 'N';
        $model->reminderAction = $result->ReminderAction;
        $model->datevAccountNumber = $result->DatevAccountNr;

        return $model;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function getPaymentCode(): string
    {
        return $this->paymentCode;
    }

    public function getShopId(): string
    {
        return $this->shopId;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): string
    {
        return $this->updatedBy;
    }

    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    public function isTaxesOnInvoice(): bool
    {
        return $this->taxesOnInvoice;
    }

    public function isPosCustomer(): bool
    {
        return $this->posCustomer;
    }

    public function getReminderAction(): string
    {
        return $this->reminderAction;
    }

    public function getDatevAccountNumber(): string
    {
        return $this->datevAccountNumber;
    }
}
