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

namespace Pim\ProductBundle\Services\Tag\Lists\Version1\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Tag
 * @package Pim\ProductBundle\Services\Tag\Lists\Version1\Response
 */
class Tag
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
     * @var string
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private $description = "";

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
     * @return Tag
     */
    public function setUuid(string $uuid): Tag
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
     * @return Tag
     */
    public function setName(string $name): Tag
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Tag
     */
    public function setDescription(string $description): Tag
    {
        $this->description = $description;
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
     * @return Tag
     */
    public function setCreated(\DateTime $created): Tag
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
     * @return Tag
     */
    public function setUpdated(\DateTime $updated): Tag
    {
        $this->updated = $updated;
        return $this;
    }
}
