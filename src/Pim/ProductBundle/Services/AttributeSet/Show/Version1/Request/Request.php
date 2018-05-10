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

namespace Pim\ProductBundle\Services\AttributeSet\Show\Version1\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package Pim\ProductBundle\Services\AttributeSet\Show\Version1\Request
 */
class Request
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex("/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/")
     */
    private $uuid = '';

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
}
