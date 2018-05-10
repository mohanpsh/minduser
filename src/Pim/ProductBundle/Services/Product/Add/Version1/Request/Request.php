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

namespace Pim\ProductBundle\Services\Product\Add\Version1\Request;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package Pim\ProductBundle\Services\AddProduct\Version1\Request
 */
class Request
{
    /**
     * @var string
     * @Serializer\SerializedName("sku")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $sku;

    /**
     * @var string
     *
     * @Serializer\SerializedName("language")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $language;

    /**
     * @var string
     *
     * @Serializer\SerializedName("seoUrl")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @Serializer\SerializedName("canonicalUrl")
     * @Serializer\Type("string")
     *
     * @Assert\Type("string")
     */
    private $canonicalUrl;

    /**
     * @var string
     *
     * @Serializer\SerializedName("title")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @Serializer\SerializedName("subTitle")
     * @Serializer\Type("string")
     *
     * @Assert\Type("string")
     */
    private $subTitle;

    /**
     * @var string
     *
     * @Serializer\SerializedName("shortDesc")
     * @Serializer\Type("string")
     *
     * @Assert\Type("string")
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @Serializer\SerializedName("longDesc")
     * @Serializer\Type("string")
     *
     * @Assert\Type("string")
     */
    private $longDesc;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceNetto")
     * @Serializer\Type("double")
     *
     * @Assert\Type("double")
     */
    private $priceNetto;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceBrutto")
     * @Serializer\Type("double")
     *
     * @Assert\Type("double")
     */
    private $priceBrutto;

    /**
     * @var float
     *
     * @Serializer\SerializedName("priceVAT")
     * @Serializer\Type("double")
     *
     * @Assert\Type("double")
     */
    private $priceVAT;

    /**
     * @var boolean
     *
     * @Serializer\SerializedName("reducible")
     * @Serializer\Type("boolean")
     *
     * @Assert\Type("boolean")
     */
    private $reducible;

    /**
     * @var integer
     *
     * @Serializer\SerializedName("inStock")
     * @Serializer\Type("integer")
     *
     * @Assert\Type("integer")
     */
    private $inStock;

    /**
     * @var integer
     *
     * @Serializer\SerializedName("deliveryTimeInDays")
     * @Serializer\Type("integer")
     *
     * @Assert\Type("integer")
     */
    private $deliveryTimeInDays;

    /**
     * @var Attribute[]|null
     *
     * @Serializer\SerializedName("attributes")
     * @Serializer\Type("ArrayCollection<Pim\ProductBundle\Services\Product\Add\Version1\Request\Attribute>")
     *
     * @Assert\Valid
     */
    private $attributes;

    /**
     * @var boolean
     *
     * @Serializer\SerializedName("active")
     * @Serializer\Type("boolean")
     *
     * @Assert\Type("boolean")
     */
    private $active;

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @param string $sku
     * @return Request
     */
    public function setSku(string $sku): Request
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
     * @return Request
     */
    public function setLanguage(string $language): Request
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
     * @return Request
     */
    public function setSeoUrl(string $seoUrl): Request
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
     * @return Request
     */
    public function setCanonicalUrl(string $canonicalUrl): Request
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
     * @return Request
     */
    public function setTitle(string $title): Request
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
     * @return Request
     */
    public function setSubTitle(string $subTitle): Request
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
     * @return Request
     */
    public function setShortDesc(string $shortDesc): Request
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
     * @return Request
     */
    public function setLongDesc(string $longDesc): Request
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
     * @return Request
     */
    public function setPriceNetto(float $priceNetto): Request
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
     * @return Request
     */
    public function setPriceBrutto(float $priceBrutto): Request
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
     * @return Request
     */
    public function setPriceVAT(float $priceVAT): Request
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
     * @return Request
     */
    public function setReducible(bool $reducible): Request
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
     * @return Request
     */
    public function setInStock(int $inStock): Request
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
     * @return Request
     */
    public function setDeliveryTimeInDays(int $deliveryTimeInDays): Request
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
     * @return Request
     */
    public function addAttribute(Attribute $attribute): Request
    {
        if(!$this->attributes->contains($attribute)){
            $this->attributes->add($attribute);
        }

        return $this;
    }

    /**
     * @param Attribute[] $attributes
     * @return Request
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
     * @return Request
     */
    public function setActive(bool $active): Request
    {
        $this->active = $active;
        return $this;
    }
}
