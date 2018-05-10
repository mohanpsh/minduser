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

namespace Pim\ProductBundle\Services\Product\Add\Version1\Response;

use AppBundle\Rest\Api\Response\ResponseInterface;
use JMS\Serializer\Annotation as Serializer;
use Pim\ProductBundle\Services\Common\ResponseTrait;

/**
 * Class Response
 * @Serializer\AccessorOrder("custom", custom={"code","status","message","date","scriptTimeSeconds","errors"})
 * @package Pim\ProductBundle\Services\AddProduct\Version1\Response
 */
class Response implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @var string
     * @Serializer\SerializedName("sku")
     * @Serializer\Type("string")
     */
    private $sku;

    /**
     * @var string
     * @Serializer\SerializedName("productId")
     * @Serializer\Type("string")
     */
    private $productId;

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Response
     */
    public function setSku(string $sku): Response
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return Response
     */
    public function setProductId(string $productId): Response
    {
        $this->productId = $productId;
        return $this;
    }
}
