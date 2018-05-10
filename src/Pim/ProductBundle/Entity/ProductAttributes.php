<?php

namespace Pim\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pim_product_attributes")
 * @ORM\Entity
 */
class ProductAttributes
{
    /**
     * @var \Ramsey\Uuid\Uuid
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uuid;

    /**
     * @var string
     * @ORM\Column(name="section", type="string", length=255)
     */
    private $section = "";

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name = "";

    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value = "";

    /**
     * @var float
     * @ORM\Column(name="price_vat", type="decimal", precision=2)
     */
    private $addPrice = 0;

    /**
     * @var bool
     * @ORM\Column(name="multiple", type="boolean")
     */
    private $multiple = false;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productAttributes")
     * @ORM\JoinColumn(name="product_uuid", referencedColumnName="uuid", nullable=FALSE)
     */
    private $product;

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getUuid(): \Ramsey\Uuid\Uuid
    {
        return $this->uuid;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $uuid
     * @return ProductAttributes
     */
    public function setUuid(\Ramsey\Uuid\Uuid $uuid): ProductAttributes
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     * @return ProductAttributes
     */
    public function setSection(string $section): ProductAttributes
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductAttributes
     */
    public function setName(string $name): ProductAttributes
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return ProductAttributes
     */
    public function setValue(string $value): ProductAttributes
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return float
     */
    public function getAddPrice(): float
    {
        return $this->addPrice;
    }

    /**
     * @param float $addPrice
     * @return ProductAttributes
     */
    public function setAddPrice(float $addPrice): ProductAttributes
    {
        $this->addPrice = $addPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     * @return ProductAttributes
     */
    public function setMultiple(bool $multiple): ProductAttributes
    {
        $this->multiple = $multiple;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductAttributes
     */
    public function setProduct(Product $product): ProductAttributes
    {
        $this->product = $product;
        return $this;
    }
}
