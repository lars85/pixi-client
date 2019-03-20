<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Response\General\GetCurrencies;

class Currency
{
    /** @var int */
    private $id;

    /** @var string */
    private $code;

    /** @var bool */
    private $active;

    /** @var int|null */
    private $localId;

    private function __construct()
    {
    }

    public static function create(\stdClass $result): self
    {
        $model = new self();

        $model->id = (int)$result->Id;
        $model->code = $result->Code;
        $model->active = $result->Active === '1';
        $model->localId = isset($result->LocaleId) ? ((int) $result->LocaleId) : null;

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getLocalId(): ?int
    {
        return $this->localId;
    }
}