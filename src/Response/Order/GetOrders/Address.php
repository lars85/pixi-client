<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\Order\GetOrders;

use Koempf\PixiClient\Helper;

class Address
{
    /** @var string */
    private $id;
    /** @var string */
    private $customerNumber;
    /** @var string */
    private $shopId;
    /** @var string */
    private $fullName;
    /** @var string */
    private $firstName;
    /** @var string */
    private $lastName;
    /** @var string|null */
    private $company;
    /** @var string */
    private $streetWithHouseNumber;
    /** @var string */
    private $street;
    /** @var string */
    private $houseNumber;
    /** @var string */
    private $city;
    /** @var string */
    private $zip;
    /** @var string */
    private $countryId;
    /** @var string */
    private $countryName;
    /** @var string */
    private $countryIso2Code;
    /** @var string */
    private $countryIso3Code;
    /** @var string */
    private $phone;
    /** @var string */
    private $eMail;
    /** @var \DateTime */
    private $createDate;
    /** @var bool */
    private $locked;
    /** @var string */
    private $createdBy;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = $result->AddrNr;
        $model->customerNumber = $result->CustomerNrExternal;
        $model->shopId = $result->ShopID;
        $model->fullName = $result->Name;
        $model->firstName = $result->FirstName;
        $model->lastName = $result->LastName;
        $model->company = $result->Company ?: null;
        $model->streetWithHouseNumber = $result->Address;
        $model->street = $result->Street;
        $model->houseNumber = $result->HouseNr;
        $model->city = $result->City;
        $model->zip = $result->ZIP;
        $model->countryId = trim($result->CountryCodePixi);
        $model->countryName = $result->CountryName;
        $model->countryIso2Code = trim($result->CountryCodeISO2);
        $model->countryIso3Code = trim($result->CountryCodeISO3);
        $model->phone = $result->Phone;
        $model->eMail = $result->eMail;
        $model->createDate = Helper::createDateTime($result->CreateDate);
        $model->createdBy = $result->CreateEmp;
        $model->locked = $result->Locked !== 'N';

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    public function getShopId(): string
    {
        return $this->shopId;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getStreetWithHouseNumber(): string
    {
        return $this->streetWithHouseNumber;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCountryId(): string
    {
        return $this->countryId;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getCountryIso2Code(): string
    {
        return $this->countryIso2Code;
    }

    public function getCountryIso3Code(): string
    {
        return $this->countryIso3Code;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEMail(): string
    {
        return $this->eMail;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }
}
