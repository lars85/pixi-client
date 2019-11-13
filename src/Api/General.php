<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use DateTime;
use DateTimeZone;
use Koempf\PixiClient\Response\General\GetCountries\Countries;
use Koempf\PixiClient\Response\General\GetCurrencies\Currencies;

class General extends AbstractApi
{
    public function getCurrencies(): Currencies
    {
        $results = $this->soapClient->getResults('pixiGetCurrency');

        return Currencies::create($results);
    }

    public function getCountries(): Countries
    {
        $results = $this->soapClient->getResults('pixiGetCountries');

        return Countries::create($results);
    }

    public function getServerTime(): DateTime
    {
        $result = $this->soapClient->getResult('pixiGetServerTime');

        return new DateTime($result->ServerTime, new DateTimeZone('Europe/Berlin'));
    }
}
