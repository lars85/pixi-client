<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Api;

use Koempf\PixiClient\Response\General\GetCurrencies\Currencies;
use Koempf\PixiClient\Response\General\GetCountries\Countries;

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
}