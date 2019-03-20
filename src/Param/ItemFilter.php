<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Param;

use Koempf\PixiClient\Helper;
use Webmozart\Assert\Assert;

class ItemFilter
{
    /** @var array */
    private $filters = [];

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    private function getFilters(): array
    {
        return $this->filters;
    }

    public function __toXml(): ?string
    {
        Assert::notEmpty($this->getFilters());
        return Helper::arrayToXml(['ITEM' => $this->getFilters()], 'ITEMS');
    }

    public function addId(int $id, ?string $vendor = null): self
    {
        $this->filters[] = $this->getFilterDataWithVendor('ITEMKEY', $id, $vendor);
        return $this;
    }

    /**
     * @param int[] $ids
     * @param string|null $vendor
     * @return self
     */
    public function addIds(array $ids, ?string $vendor = null): self
    {
        foreach ($ids as $id) {
            Assert::integer($id);
            $this->addId($id, $vendor);
        }
        return $this;
    }

    public function addGtin(string $gtin, ?string $vendor = null): self
    {
        $this->filters[] = $this->getFilterDataWithVendor('EAN', $gtin, $vendor);
        return $this;
    }

    /**
     * @param string[] $gtins
     * @param string|null $vendor
     * @return self
     */
    public function addGtins(array $gtins, ?string $vendor = null): self
    {
        foreach ($gtins as $gtin) {
            Assert::string($gtin);
            $this->addGtin($gtin, $vendor);
        }
        return $this;
    }

    public function addSku(string $sku, ?string $vendor = null): self
    {
        $this->filters[] = $this->getFilterDataWithVendor('ITEMNRINT', $sku, $vendor);
        return $this;
    }

    /**
     * @param string[] $skus
     * @param string|null $vendor
     * @return self
     */
    public function addSkus(array $skus, ?string $vendor = null): self
    {
        foreach ($skus as $sku) {
            Assert::string($sku);
            $this->addSku($sku, $vendor);
        }
        return $this;
    }

    public function addVendorNumber(string $vendorNumber, ?string $vendor = null): self
    {
        $this->filters[] = $this->getFilterDataWithVendor('ITEMNRSUPPL', $vendorNumber, $vendor);
        return $this;
    }

    /**
     * @param string[] $vendorNumbers
     * @param string|null $vendor
     * @return self
     */
    public function addVendorNumbers(array $vendorNumbers, ?string $vendor = null): self
    {
        foreach ($vendorNumbers as $vendorNumber) {
            Assert::string($vendorNumber);
            $this->addVendorNumber($vendorNumber, $vendor);
        }
        return $this;
    }

    public function addInternalItemNumber(string $internalItemNumber, ?string $vendor = null): self
    {
        $this->filters[] = $this->getFilterDataWithVendor('INTERNALITEMNUMBER', $internalItemNumber, $vendor);
        return $this;
    }

    /**
     * @param string[] $internalItemNumbers
     * @param string|null $vendor
     * @return self
     */
    public function addInternalItemNumbers(array $internalItemNumbers, ?string $vendor = null): self
    {
        foreach ($internalItemNumbers as $internalItemNumber) {
            Assert::string($internalItemNumber);
            $this->addInternalItemNumber($internalItemNumber, $vendor);
        }
        return $this;
    }


    private function getFilterDataWithVendor(string $filterKey, $filterValue, ?string $vendor = null): array
    {
        $filter = [$filterKey => $filterValue];
        if (!empty($vendor)) {
            Assert::regex($vendor, '/^[A-Z]{3,4}$/','Vendor muss aus 3-4 Grossbuchstaben bestehen!');
            $filter['SUPPLNR'] = $vendor;
        }
        return $filter;
    }
}
