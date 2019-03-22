<?php

declare(strict_types=1);

namespace Koempf\PixiClient;

use Koempf\PixiClient\Client\SoapClient;

class PixiClient implements PixiClientInterface
{
    /** @var SoapClient */
    private $soapClient;

    public function __construct(string $login, string $password, string $uri)
    {
        $this->soapClient = new SoapClient($login, $password, $uri);
    }

    public function stock(): Api\Stock
    {
        return new Api\Stock($this->soapClient);
    }

    public function product(): Api\Product
    {
        return new Api\Product($this->soapClient);
    }

    public function order(): Api\Order
    {
        return new Api\Order($this->soapClient);
    }

    public function general(): Api\General
    {
        return new Api\General($this->soapClient);
    }
}
