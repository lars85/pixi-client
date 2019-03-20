<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Tests\Params\Product;

use Koempf\PixiClient\Param\ItemFilter;
use Koempf\PixiClient\Tests\TestCase;

class ItemInfoFilterTest extends TestCase
{
    public function testIds()
    {
        $filter = ItemFilter::create()->addIds([123, 456]);

        $this->assertSame(
            '<?xml version="1.0"?>
<ITEMS>
  <ITEM>
    <ITEMKEY>123</ITEMKEY>
  </ITEM>
  <ITEM>
    <ITEMKEY>456</ITEMKEY>
  </ITEM>
</ITEMS>
',
            $filter->__toXml()
        );
    }

    public function testGtinWithSupplier()
    {
        $filter = ItemFilter::create()->addGtins(['1234567891011', '2345678910111'], 'SANI');

        $this->assertSame(
            '<?xml version="1.0"?>
<ITEMS>
  <ITEM>
    <EAN>1234567891011</EAN>
    <SUPPLNR>SANI</SUPPLNR>
  </ITEM>
  <ITEM>
    <EAN>2345678910111</EAN>
    <SUPPLNR>SANI</SUPPLNR>
  </ITEM>
</ITEMS>
',
            $filter->__toXml()
        );
    }
}
