<?php

namespace Crm\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class InvoicePosition
 * @ORM\Table(name="crm_invoice_invoice_positions")
 * @ORM\Entity
 */
class InvoicePosition
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @var Invoice
     *
     * @ORM\ManyToOne(
     *     targetEntity="Crm\InvoiceBundle\Entity\Invoice",
     *     inversedBy="invoicePositions"
     * )
     */
    private $invoice;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=64)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=512)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="decription_one", type="string", nullable=true, length=1024)
     */
    private $descriptionOne = '';

    /**
     * @var string
     *
     * @ORM\Column(name="decription_two", type="string", nullable=true, length=1024)
     */
    private $descriptionTwo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="decription_image", type="string", length=255, nullable=true)
     */
    private $descriptionImage = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="net_price", type="decimal", precision=7, scale=2)
     */
    private $netPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="gross_price", type="decimal", precision=7, scale=2)
     */
    private $grossPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="net_price_total", type="decimal", precision=7, scale=2)
     */
    private $netPriceTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="gross_price_total", type="decimal", precision=7, scale=2)
     */
    private $grossPriceTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="vat_rate", type="float")
     */
    private $vatRate;

    /**
     * @var float
     *
     * @ORM\Column(name="vat_price", type="decimal", precision=7, scale=2)
     */
    private $vatPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="vat_price_total", type="decimal", precision=7, scale=2)
     */
    private $vatPriceTotal;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     */
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescriptionOne(): string
    {
        return $this->descriptionOne;
    }

    /**
     * @param string $descriptionOne
     */
    public function setDescriptionOne(string $descriptionOne)
    {
        $this->descriptionOne = $descriptionOne;
    }

    /**
     * @return string
     */
    public function getDescriptionTwo(): string
    {
        return $this->descriptionTwo;
    }

    /**
     * @param string $descriptionTwo
     */
    public function setDescriptionTwo(string $descriptionTwo)
    {
        $this->descriptionTwo = $descriptionTwo;
    }

    /**
     * @return string
     */
    public function getDescriptionImage(): string
    {
        return $this->descriptionImage;
    }

    /**
     * @param string $descriptionImage
     */
    public function setDescriptionImage(string $descriptionImage)
    {
        $this->descriptionImage = $descriptionImage;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getNetPrice(): float
    {
        return $this->netPrice;
    }

    /**
     * @param float $netPrice
     */
    public function setNetPrice(float $netPrice)
    {
        $this->netPrice = $netPrice;
    }

    /**
     * @return float
     */
    public function getGrossPrice(): float
    {
        return $this->grossPrice;
    }

    /**
     * @param float $grossPrice
     */
    public function setGrossPrice(float $grossPrice)
    {
        $this->grossPrice = $grossPrice;
    }

    /**
     * @return float
     */
    public function getNetPriceTotal(): float
    {
        return $this->netPriceTotal;
    }

    /**
     * @param float $netPriceTotal
     */
    public function setNetPriceTotal(float $netPriceTotal)
    {
        $this->netPriceTotal = $netPriceTotal;
    }

    /**
     * @return float
     */
    public function getGrossPriceTotal(): float
    {
        return $this->grossPriceTotal;
    }

    /**
     * @param float $grossPriceTotal
     */
    public function setGrossPriceTotal(float $grossPriceTotal)
    {
        $this->grossPriceTotal = $grossPriceTotal;
    }

    /**
     * @return float
     */
    public function getVatRate(): float
    {
        return $this->vatRate;
    }

    /**
     * @param float $vatRate
     */
    public function setVatRate(float $vatRate)
    {
        $this->vatRate = $vatRate;
    }

    /**
     * @return float
     */
    public function getVatPrice(): float
    {
        return $this->vatPrice;
    }

    /**
     * @param float $vatPrice
     */
    public function setVatPrice(float $vatPrice)
    {
        $this->vatPrice = $vatPrice;
    }

    /**
     * @return float
     */
    public function getVatPriceTotal(): float
    {
        return $this->vatPriceTotal;
    }

    /**
     * @param float $vatPriceTotal
     */
    public function setVatPriceTotal(float $vatPriceTotal)
    {
        $this->vatPriceTotal = $vatPriceTotal;
    }
}
