<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Client\SoapClient;

class AbstractApi
{
    /** @var SoapClient */
    protected $soapClient;

    public function __construct(SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    protected function __getFormattedDateTime(\DateTime $date): string
    {
        return $date->setTimezone(new \DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s');
    }
}