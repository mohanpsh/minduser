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

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 * @package Pim\ProductBundle\Services\Product\Add\Version1\Request
 */
class Category
{
    /**
     * @var string
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     * @Assert\Type("string")
     */
    private $uuid = "";

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
}
