<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\General\GetCountries;

class Country
{
    /** @var string */
    private $code;
    /** @var string */
    private $name;
    /** @var string */
    private $dateFormat;
    /** @var string */
    private $languageCode;
    /** @var string */
    private $iso2Code;
    /** @var string|null */
    private $iso3Code;
    /** @var bool */
    private $chargeTaxes;
    /** @var float */
    private $taxesLimit;
    /** @var array */
    private $names;
    /** @var bool */
    private $isEurope;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->code = $result->CntCode;
        $model->name = $result->CntName;
        $model->dateFormat = $result->DateFormat;
        $model->languageCode = $result->LangCode;
        $model->iso2Code = $result->CntCodeISO2;
        $model->iso3Code = $result->CntCodeIsO3 ?? null;
        $model->chargeTaxes = $result->ChargeVAT === 'Y';
        $model->taxesLimit = isset($result->VATLimit) ? (float)$result->VATLimit : 0;
        $model->names = explode(',', $result->CntNames);
        $model->isEurope = !empty($result->IsEU);

        return $model;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function getIso2Code(): string
    {
        return $this->iso2Code;
    }

    public function getIso3Code(): ?string
    {
        return $this->iso3Code;
    }

    public function isChargeTaxes(): bool
    {
        return $this->chargeTaxes;
    }

    public function getTaxesLimit(): float
    {
        return $this->taxesLimit;
    }

    public function getNames(): array
    {
        return $this->names;
    }

    public function isEurope(): bool
    {
        return $this->isEurope;
    }
}