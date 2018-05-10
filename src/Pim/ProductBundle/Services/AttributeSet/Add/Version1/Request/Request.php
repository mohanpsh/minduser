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

namespace Pim\ProductBundle\Services\AttributeSet\Add\Version1\Request;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package Pim\ProductBundle\Services\AttributeSet\Add\Version1\Request
 */
class Request
{
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
