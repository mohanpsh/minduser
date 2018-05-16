<?php

namespace Crm\InvoiceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="crm_invoice_invoice")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=36, nullable=true)
     */
    private $customerId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=12, nullable=true)
     */
    private $locale = '';

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=true)
     */
    private $currency = '';

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_id", type="string", length=32, nullable=true)
     */
    private $invoiceId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_date", type="date", nullable=true)
     */
    private $invoiceDate = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_transaction_id", type="string", length=32, nullable=true)
     */
    private $paymentTransactionId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_provider", type="string", length=32, nullable=true)
     */
    private $paymentProvider = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=32, nullable=true)
     */
    private $paymentMethod = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_account", type="string", length=32, nullable=true)
     */
    private $paymentAccount = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_status", type="string", length=32, nullable=true)
     */
    private $paymentStatus = '';

    /**
     * @var float
     *
     * @ORM\Column(name="net_price_total", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $netPriceTotal = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="gross_price_total", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $grossPriceTotal = 0;

    /**
     * @var array
     *
     * @ORM\Column(name="vat_price_total", type="array", nullable=true)
     */
    private $vatPriceTotal = [];

    /**
     * @var string
     *
     * @ORM\Column(name="footer_one", type="string", length=255, nullable=true)
     */
    private $footerOne = '';

    /**
     * @var string
     *
     * @ORM\Column(name="footer_two", type="string", length=255, nullable=true)
     */
    private $footerTwo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_notes", type="text", nullable=true)
     */
    private $invoiceNotes = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="cancellation", type="boolean", nullable=true)
     */
    private $cancellation = false;

    /**
     * @ORM\Column(name="cancellation_pdf_name", type="string", length=64, nullable=true)
     */
    private $cancellationPdfName = '';

    /**
     * @ORM\Column(name="pdf_name", type="string", length=64, nullable=true)
     */
    private $pdfName = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var InvoiceRecipient
     *
     * @ORM\OneToOne(
     *     targetEntity="Crm\InvoiceBundle\Entity\InvoiceRecipient",
     *     mappedBy="invoice",
     *     cascade={"ALL"}
     * )
     */
    private $recipient;

    /**
     * @var ArrayCollection|InvoicePosition[]
     *
     * @ORM\OneToMany(
     *     targetEntity="InvoicePosition",
     *     mappedBy="invoice",
     *     cascade={"ALL"}
     * )
     */
    private $invoicePositions;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->invoicePositions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     * @return Invoice
     */
    public function setCustomerId(string $customerId): Invoice
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * @param string $invoiceId
     */
    public function setInvoiceId(string $invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate(): \DateTime
    {
        return $this->invoiceDate;
    }

    /**
     * @param \DateTime $invoiceDate
     */
    public function setInvoiceDate(\DateTime $invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     * @return string
     */
    public function getPaymentTransactionId(): string
    {
        return $this->paymentTransactionId;
    }

    /**
     * @param string $paymentTransactionId
     */
    public function setPaymentTransactionId(string $paymentTransactionId)
    {
        $this->paymentTransactionId = $paymentTransactionId;
    }

    /**
     * @return string
     */
    public function getPaymentProvider(): string
    {
        return $this->paymentProvider;
    }

    /**
     * @param string $paymentProvider
     */
    public function setPaymentProvider(string $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod(string $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getPaymentAccount(): string
    {
        return $this->paymentAccount;
    }

    /**
     * @param string $paymentAccount
     */
    public function setPaymentAccount(string $paymentAccount)
    {
        $this->paymentAccount = $paymentAccount;
    }

    /**
     * @return string
     */
    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * @param string $paymentStatus
     * @return Invoice
     */
    public function setPaymentStatus(string $paymentStatus): Invoice
    {
        $this->paymentStatus = $paymentStatus;
        return $this;
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
     * @param float $vatRate
     * @param float $vatPrice
     */
    private function addVatPrice(float $vatRate, float $vatPrice)
    {
        $vatKey = (string)$vatRate;
        if (!array_key_exists($vatKey, $this->vatPriceTotal)) {
            $this->vatPriceTotal[$vatKey] = $vatPrice;
        } else {
            $this->vatPriceTotal[$vatKey] += $vatPrice;
        }
    }

    /**
     * Key/value list of vatRate/vatPriceTotal
     *
     * @return array
     */
    public function getVatPriceTotal(): array
    {
        return $this->vatPriceTotal;
    }

    /**
     * @return bool
     */
    public function isTaxable(): bool
    {
        return $this->vatPriceTotal > 0.01;
    }

    /**
     * @return string
     */
    public function getFooterOne(): string
    {
        return $this->footerOne;
    }

    /**
     * @param string $footerOne
     * @return Invoice
     */
    public function setFooterOne(string $footerOne): Invoice
    {
        $this->footerOne = $footerOne;
        return $this;
    }

    /**
     * @return string
     */
    public function getFooterTwo(): string
    {
        return $this->footerTwo;
    }

    /**
     * @param string $footerTwo
     * @return Invoice
     */
    public function setFooterTwo(string $footerTwo): Invoice
    {
        $this->footerTwo = $footerTwo;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNotes()
    {
        return $this->invoiceNotes;
    }

    /**
     * @param string $invoiceNotes
     * @return Invoice
     */
    public function setInvoiceNotes($invoiceNotes): Invoice
    {
        $this->invoiceNotes = $invoiceNotes;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCancellation(): bool
    {
        return $this->cancellation;
    }

    /**
     * @param bool $cancellation
     * @return Invoice
     */
    public function setCancellation(bool $cancellation): Invoice
    {
        $this->cancellation = $cancellation;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancellationPdfName()
    {
        return $this->cancellationPdfName;
    }

    /**
     * @param string $cancellationPdfName
     * @return Invoice
     */
    public function setCancellationPdfName($cancellationPdfName)
    {
        $this->cancellationPdfName = $cancellationPdfName;
        return $this;
    }

    /**
     * @return InvoiceRecipient
     */
    public function getRecipient(): InvoiceRecipient
    {
        return $this->recipient;
    }

    /**
     * @param InvoiceRecipient $recipient
     */
    public function setRecipient(InvoiceRecipient $recipient)
    {
        $this->recipient = $recipient;
        $this->recipient->setInvoice($this);
    }

    /**
     * @param InvoicePosition $invoicePosition
     */
    public function addInvoicePosition(InvoicePosition $invoicePosition)
    {
        $invoicePosition->setInvoice($this);
        $this->invoicePositions->add($invoicePosition);
        $this->addVatPrice($invoicePosition->getVatRate(), $invoicePosition->getVatPriceTotal());
    }

    /**
     * @return ArrayCollection|InvoicePosition[]
     */
    public function getInvoicePositions()
    {
        return $this->invoicePositions;
    }

    /**
     * @return string
     */
    public function getPdfName()
    {
        return $this->pdfName;
    }

    /**
     * @param string $pdfName
     * @return Invoice
     */
    public function setPdfName($pdfName)
    {
        $this->pdfName = $pdfName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->updated = new \DateTime();
        $this->created = new \DateTime();
    }
}
