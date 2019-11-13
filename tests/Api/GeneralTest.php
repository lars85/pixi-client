<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Api\OrdersResponse;

use DateTime;
use DateTimeZone;
use Koempf\PixiClient\Tests\Api\TestCase;

class GeneralTest extends TestCase
{
    public function testCurrencies(): void
    {
        $currencies = $this->getPixiClient()->general()->getCurrencies();

        $this->assertGreaterThan(160, count($currencies));
        $this->assertSame(1, $currencies['EUR']->getId());
        $this->assertTrue($currencies['EUR']->isActive());
    }

    public function testCountries(): void
    {
        $countries = $this->getPixiClient()->general()->getCountries();

        $this->assertGreaterThan(200, count($countries));
        $this->assertSame('D', $countries['D']->getCode());
        $this->assertSame('Deutschland', $countries['D']->getName());
        $this->assertSame('dd.mm.yy', $countries['D']->getDateFormat());
        $this->assertSame('GER', $countries['D']->getLanguageCode());
        $this->assertSame('DE', $countries['D']->getIso2Code());
        $this->assertSame('DEU', $countries['D']->getIso3Code());
        $this->assertTrue($countries['D']->isChargeTaxes());
        $this->assertGreaterThan(1000, $countries['D']->getTaxesLimit());
        $this->assertTrue(in_array('Deutschland', $countries['D']->getNames()));
        $this->assertTrue($countries['D']->isEurope());
    }

    public function testServerTime(): void
    {
        $serverTime = $this->getPixiClient()->general()->getServerTime();

        $now = new DateTime('now', new DateTimeZone('Europe/Berlin'));
        $diff = abs($serverTime->getTimestamp() - $now->getTimestamp());

        $this->assertLessThan(10, $diff);
    }
}
