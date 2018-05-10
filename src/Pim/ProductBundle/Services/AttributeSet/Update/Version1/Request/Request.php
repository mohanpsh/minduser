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

namespace Pim\ProductBundle\Services\AttributeSet\Update\Version1\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package Pim\ProductBundle\Services\AttributeSet\Update\Version1\Request
 */
class Request
{
    /**
     * @var string
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Regex("/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/")
     */
    private $uuid = "";

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $name = "";

    /**
     * @var array
     * @Serializer\SerializedName("attributes")
     * @Serializer\Type("array<string, string>")
     *
     * @Assert\NotBlank()
     * @Assert\Type("array")
     */
    private $attributes = [];

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Request
     */
    public function setUuid(string $uuid): Request
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
     * @return Request
     */
    public function setName(string $name): Request
    {
        $this->name = $name;
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
     * @return Request
     */
    public function setAttributes(array $attributes): Request
    {
        $this->attributes = $attributes;
        return $this;
    }
}
