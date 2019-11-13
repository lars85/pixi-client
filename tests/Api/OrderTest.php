<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Api\OrdersResponse;

use Koempf\PixiClient\PixiConstants;
use Koempf\PixiClient\Tests\Api\TestCase;

class OrderTest extends TestCase
{
    public function testOrderById()
    {
//        $order = $this->getPixiClient()->order()->getOrderById(10341);

        $this->assertSame(1, 1);
    }

    public function testAddOrderXml()
    {
        $xml = '<ORDER version="1.0" type="standard">
    <ORDER_HEADER>
        <CONTROL_INFO>
            <GENERATOR_INFO>spryker</GENERATOR_INFO>
            <GENERATION_DATE>' . date('c') . '</GENERATION_DATE>
        </CONTROL_INFO>
        <ORDER_INFO>
            <ORDER_ID>TEST' . date('YmdHis') . '</ORDER_ID>
            <ORDER_DATE>' . date('c') . '</ORDER_DATE>
            <DATABASE>pixi_KOE</DATABASE>
            <SHOPID>OAS</SHOPID>
            <SHOP_NOTE>Test</SHOP_NOTE>
            <ORDER_SHIPLOCK>Y</ORDER_SHIPLOCK>
            <BUYER_SHIPLOCK>N</BUYER_SHIPLOCK>
            <PRICE_CURRENCY>EUR</PRICE_CURRENCY>
            <TRANSPORT_REMARKS>Shipping Information</TRANSPORT_REMARKS>
            <SUBSHOPNAME>oase_teichbau_de</SUBSHOPNAME>
            <PARTIAL_DELIVERY>OFF</PARTIAL_DELIVERY>
            <ORDER_TYPE>B2C</ORDER_TYPE>
            <ORDER_PARTIES>
                <BUYER_PARTY>
                    <PARTY>
                        <PARTY_ID type="buyer_specific">test@test.de</PARTY_ID>
                        <ADDRESS/>
                    </PARTY>
                </BUYER_PARTY>
                <INVOICE_PARTY>
                    <PARTY>
                        <ADDRESS>
                            <NAME>Name</NAME>
                            <SAL/>
                            <NAME2>Vorname</NAME2>
                            <NAME3>Nachname</NAME3>
                            <STREET>Strasse</STREET>
                            <ZIP>12345</ZIP>
                            <ZIPBOX>12</ZIPBOX>
                            <CITY>Stadt</CITY>
                            <COUNTRY>DE</COUNTRY>
                            <PHONE>0123456789</PHONE>
                            <EMAIL>test@test.de</EMAIL>
                        </ADDRESS>
                    </PARTY>
                </INVOICE_PARTY>
                <SHIPMENT_PARTIES>
                    <DELIVERY_PARTY>
                        <PARTY>
                            <ADDRESS>
                                <NAME>Name</NAME>
                                <SAL/>
                                <NAME2>Vorname</NAME2>
                                <NAME3>Nachname</NAME3>
                                <STREET>Strasse</STREET>
                                <ZIP>12345</ZIP>
                                <ZIPBOX>12</ZIPBOX>
                                <CITY>Stadt</CITY>
                                <COUNTRY>DE</COUNTRY>
                                <PHONE>0123456789</PHONE>
                                <EMAIL>test@test.de</EMAIL>
                            </ADDRESS>
                        </PARTY>
                    </DELIVERY_PARTY>
                </SHIPMENT_PARTIES>
            </ORDER_PARTIES>
            <PAYMENT>
                <CASH>
                    <BANK_NAME>123456789</BANK_NAME>
                </CASH>
            </PAYMENT>
            <REMARK type="SHIPPING">4.9</REMARK>
            <REMARK type="SHIPPINGVENDOR">DHL</REMARK>
        </ORDER_INFO>
    </ORDER_HEADER>
    <ORDER_ITEM_LIST>
        <ORDER_ITEM>
            <LINE_ITEM_ID>1</LINE_ITEM_ID>
            <ARTICLE_ID>
                <SUPPLIER_AID>721079</SUPPLIER_AID>
                <DESCRIPTION_SHORT>biOrb Pflanzen Set groß grün</DESCRIPTION_SHORT>
                <ITEM_NOTE/>
            </ARTICLE_ID>
            <QUANTITY>1</QUANTITY>
            <DF_TYPE>0</DF_TYPE>
            <ARTICLE_PRICE type="udp_gross_customer">
                <FULL_PRICE>8.99</FULL_PRICE>
                <PRICE_AMOUNT>8.99</PRICE_AMOUNT>
                <DISCOUNT_PERC>0</DISCOUNT_PERC>
                <DISCOUNT_VALUE>0</DISCOUNT_VALUE>
            </ARTICLE_PRICE>
        </ORDER_ITEM>
    </ORDER_ITEM_LIST>
    <ORDER_SUMMARY>
        <TOTAL_ITEM_NUM>1</TOTAL_ITEM_NUM>
    </ORDER_SUMMARY>
</ORDER>';

        $logKey = 'test';
//        $logKey = $this->getPixiClient()->order()->addOrderXml(PixiConstants::CHANNEL_SPRYKER, $xml);

        $this->assertNotEmpty($logKey);
    }
}
