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

namespace Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class AttributeSet
 * @package Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Response
 */
class AttributeSet
{
    /**
     * @var string
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     */
    private $uuid = "";

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name = "";

    /**
     * @var \DateTime
     * @Serializer\SerializedName("created")
     * @Serializer\Type("DateTime")
     */
    private $created;

    /**
     * @var \DateTime
     * @Serializer\SerializedName("updated")
     * @Serializer\Type("DateTime")
     */
    private $updated;

    /**
     * @var array
     * @Serializer\SerializedName("attributes")
     * @Serializer\Type("array<string, string>")
     */
    private $attributes = [];

    /**
     * AttributeSet constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return AttributeSet
     */
    public function setUuid(string $uuid): AttributeSet
    {
        $this->uuid = $uuid;
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
     * @return AttributeSet
     */
    public function setName(string $name): AttributeSet
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return AttributeSet
     */
    public function setCreated(\DateTime $created): AttributeSet
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return AttributeSet
     */
    public function setUpdated(\DateTime $updated): AttributeSet
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return AttributeSet
     */
    public function setAttributes(array $attributes): AttributeSet
    {
        $this->attributes = $attributes;
        return $this;
    }
}
