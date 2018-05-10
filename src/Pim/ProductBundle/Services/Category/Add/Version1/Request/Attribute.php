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

namespace Pim\ProductBundle\Category\Product\Add\Version1\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Attribute
 * @package Pim\ProductBundle\Category\AddProduct\Version1\Request
 */
class Attribute
{
    /**
     * @var string
     * @Serializer\SerializedName("section")
     * @Serializer\Type("string")
     */
    private $section = "";

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name = "";

    /**
     * @var string
     * @Serializer\SerializedName("value")
     * @Serializer\Type("string")
     */
    private $value = "";

    /**
     * @var float
     *
     * @Serializer\SerializedName("addPrice")
     * @Serializer\Type("double")
     */
    private $addPrice = 0;

    /**
     * @var boolean
     * @Serializer\SerializedName("multiple")
     * @Serializer\Type("boolean")
     */
    private $multiple = false;

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     * @return Attribute
     */
    public function setSection(string $section): Attribute
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
     * @return Attribute
     */
    public function setName(string $name): Attribute
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
     * @return Attribute
     */
    public function setValue(string $value): Attribute
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
     * @return Attribute
     */
    public function setAddPrice(float $addPrice): Attribute
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
     * @return Attribute
     */
    public function setMultiple(bool $multiple): Attribute
    {
        $this->multiple = $multiple;
        return $this;
    }
}
