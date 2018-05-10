<?php

namespace Pim\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pim_products")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uuid;

    /**
     * @var string
     * @ORM\Column(name="sku", type="string", length=255, unique=true)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=10)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=255, nullable=true)
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="canonical_url", type="string", length=255, nullable=true)
     */
    private $canonicalUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_title", type="string", length=255)
     */
    private $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="short_desc", type="text", nullable=true)
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="long_desc", type="text", nullable=true)
     */
    private $longDesc;

    /**
     * @var float
     *
     * @ORM\Column(name="price_netto", type="decimal", precision=2)
     */
    private $priceNetto;

    /**
     * @var float
     *
     * @ORM\Column(name="price_brutto", type="decimal", precision=2)
     */
    private $priceBrutto;

    /**
     * @var float
     *
     * @ORM\Column(name="price_vat", type="decimal", precision=2)
     */
    private $priceVAT;

    /**
     * @var boolean
     *
     * @ORM\Column(name="price_reducible", type="boolean", nullable=true)
     */
    private $reducible;

    /**
     * @var integer
     *
     * @ORM\Column(name="in_stock", type="integer", nullable=true)
     */
    private $inStock;

    /**
     * @var integer
     * @ORM\Column(name="delivery_time", type="integer", nullable=true)
     */
    private $deliveryTimeInDays;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var Category[]
     * @ORM\ManyToMany(targetEntity="Category",inversedBy="products")
     * @ORM\JoinTable(name="pim_product_has_category",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="uuid")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="uuid")}
     * )
     */
    private $categories;

    /**
     * @var Tags[]
     * @ORM\ManyToMany(targetEntity="Tags",inversedBy="products")
     * @ORM\JoinTable(name="pim_product_has_tags",
     *      joinColumns={@ORM\JoinColumn(name="products_id", referencedColumnName="uuid")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tags_id", referencedColumnName="uuid")}
     * )
     */
    private $tags;

    /**
     * @var ProductAttributes[]
     * @ORM\OneToMany(targetEntity="ProductAttributes", mappedBy="product")
     */
    private $attributes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getUuid(): \Ramsey\Uuid\Uuid
    {
        return $this->uuid;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $uuid
     * @return Product
     */
    public function setUuid(\Ramsey\Uuid\Uuid $uuid): Product
    {
        $this->uuid = $uuid;
        return $this;
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
     * @return Product
     */
    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Product
     */
    public function setLanguage(string $language): Product
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoUrl(): string
    {
        return $this->seoUrl;
    }

    /**
     * @param string $seoUrl
     * @return Product
     */
    public function setSeoUrl(string $seoUrl): Product
    {
        $this->seoUrl = $seoUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCanonicalUrl(): string
    {
        return $this->canonicalUrl;
    }

    /**
     * @param string $canonicalUrl
     * @return Product
     */
    public function setCanonicalUrl(string $canonicalUrl): Product
    {
        $this->canonicalUrl = $canonicalUrl;
        return $this;
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
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubTitle(): string
    {
        return $this->subTitle;
    }

    /**
     * @param string $subTitle
     * @return Product
     */
    public function setSubTitle(string $subTitle): Product
    {
        $this->subTitle = $subTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDesc(): string
    {
        return $this->shortDesc;
    }

    /**
     * @param string $shortDesc
     * @return Product
     */
    public function setShortDesc(string $shortDesc): Product
    {
        $this->shortDesc = $shortDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    /**
     * @param string $longDesc
     * @return Product
     */
    public function setLongDesc(string $longDesc): Product
    {
        $this->longDesc = $longDesc;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceNetto(): float
    {
        return $this->priceNetto;
    }

    /**
     * @param float $priceNetto
     * @return Product
     */
    public function setPriceNetto(float $priceNetto): Product
    {
        $this->priceNetto = $priceNetto;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceBrutto(): float
    {
        return $this->priceBrutto;
    }

    /**
     * @param float $priceBrutto
     * @return Product
     */
    public function setPriceBrutto(float $priceBrutto): Product
    {
        $this->priceBrutto = $priceBrutto;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceVAT(): float
    {
        return $this->priceVAT;
    }

    /**
     * @param float $priceVAT
     * @return Product
     */
    public function setPriceVAT(float $priceVAT): Product
    {
        $this->priceVAT = $priceVAT;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReducible(): bool
    {
        return $this->reducible;
    }

    /**
     * @param bool $reducible
     * @return Product
     */
    public function setReducible(bool $reducible): Product
    {
        $this->reducible = $reducible;
        return $this;
    }

    /**
     * @return int
     */
    public function getInStock(): int
    {
        return $this->inStock;
    }

    /**
     * @param int $inStock
     * @return Product
     */
    public function setInStock(int $inStock): Product
    {
        $this->inStock = $inStock;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryTimeInDays(): int
    {
        return $this->deliveryTimeInDays;
    }

    /**
     * @param int $deliveryTimeInDays
     * @return Product
     */
    public function setDeliveryTimeInDays(int $deliveryTimeInDays): Product
    {
        $this->deliveryTimeInDays = $deliveryTimeInDays;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Product
     */
    public function setActive(bool $active): Product
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return ProductAttributes[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param ProductAttributes $attribute
     * @return Product
     */
    public function addAttribute(ProductAttributes $attribute): Product
    {
        if(!$this->attributes->contains($attribute)){
            $this->attributes->add($attribute);
        }
        return $this;
    }

    /**
     * @param ProductAttributes[] $attributes
     * @return Product
     */
    public function setAttributes(array $attributes): Product
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function addCategory(Category $category): Product
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
        return $this;
    }

    /**
     * Remove categories
     *
     * @param Category $categories
     */
    public function removeCategory(Category $categories)
    {
        if ($this->categories->contains($categories)) {
            $this->categories->removeElement($categories);
        }
    }

    /**
     * Get categories
     *
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return Tags[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tags[] $tags
     * @return Product
     */
    public function setTags(array $tags): Product
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Set created
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @ORM\PreUpdate
     */
    public function setUpdated()
    {
        $this->updated = new \DateTime();
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
