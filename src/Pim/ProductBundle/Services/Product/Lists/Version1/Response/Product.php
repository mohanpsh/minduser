<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 */

namespace Pim\ProductBundle\Services\Product\Lists\Version1\Response;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Product
 * @package Pim\ProductBundle\Services\Product\Lists\Version1\Product
 */
class Product
{
    /**
     * @var string
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @var string
     * @Serializer\SerializedName("sku")
     * @Serializer\Type("string")
     */
    private $sku;

    /**
     * @var string
     *
     * @Serializer\SerializedName("language")
     * @Serializer\Type("string")
     */
    private $language;

    /**
     * @var string
     *
     * @Serializer\SerializedName("seoUrl")
     * @Serializer\Type("string")
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @Serializer\SerializedName("canonicalUrl")
     * @Serializer\Type("string")
     */
    private $canonicalUrl;

    /**
     * @var string
     *
     * @Serializer\SerializedName("title")
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @Serializer\SerializedName("subTitle")
     * @Serializer\Type("string")
     */
    private $subTitle;

    /**
     * @var string
     *
     * @Serializer\SerializedName("shortDesc")
     * @Serializer\Type("string")
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @Serializer\SerializedName("longDesc")
     * @Serializer\Type("string")
     */
    private $longDesc;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceNetto")
     * @Serializer\Type("double")
     */
    private $priceNetto;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceBrutto")
     * @Serializer\Type("double")
     */
    private $priceBrutto;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceVAT")
     * @Serializer\Type("double")
     */
    private $priceVAT;

    /**
     * @var boolean
     *
     * @Serializer\SerializedName("reducible")
     * @Serializer\Type("boolean")
     */
    private $reducible;

    /**
     * @var integer
     *
     * @Serializer\SerializedName("inStock")
     * @Serializer\Type("integer")
     */
    private $inStock;

    /**
     * @var integer
     *
     * @Serializer\SerializedName("deliveryTimeInDays")
     * @Serializer\Type("integer")
     */
    private $deliveryTimeInDays;

    /**
     * @var Attribute[]|null
     *
     * @Serializer\SerializedName("attributes")
     * @Serializer\Type("ArrayCollection<Pim\ProductBundle\Services\Product\Lists\Version1\Response\Attribute>")
     */
    private $attributes;

    /**
     * @var boolean
     *
     * @Serializer\SerializedName("active")
     * @Serializer\Type("boolean")
     */
    private $active;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Product
     */
    public function setUuid(string $uuid): Product
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
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
    public function getLanguage()
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
    public function getSeoUrl()
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
    public function getCanonicalUrl()
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
    public function getTitle()
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
    public function getSubTitle()
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
    public function getShortDesc()
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
    public function getLongDesc()
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
    public function getPriceNetto()
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
    public function getPriceBrutto()
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
    public function getPriceVAT()
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
    public function isReducible()
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
    public function getInStock()
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
    public function getDeliveryTimeInDays()
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
     * @return Attribute[]|null
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param Attribute $attribute
     * @return Product
     */
    public function addAttribute(Attribute $attribute): Product
    {
        if(!$this->attributes->contains($attribute)){
            $this->attributes->add($attribute);
        }

        return $this;
    }

    /**
     * @param Attribute[] $attributes
     * @return Product
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
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
}
