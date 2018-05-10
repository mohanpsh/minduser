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

namespace Pim\ProductBundle\Services\Tag\Add\Version1\Response;

use AppBundle\Rest\Api\Response\ResponseInterface;
use JMS\Serializer\Annotation as Serializer;
use Pim\ProductBundle\Services\Common\ResponseTrait;

/**
 * Class Response
 * @Serializer\AccessorOrder("custom", custom={"code","status","message","date","scriptTimeSeconds","errors"})
 * @package Pim\ProductBundle\Services\Tag\Add\Version1\Response
 */
class Response implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @var string
     * @Serializer\SerializedName("tagUuid")
     * @Serializer\Type("string")
     */
    private $tagUuid;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @return string
     */
    public function getTagUuid(): string
    {
        return $this->tagUuid;
    }

    /**
     * @param string $tagUuid
     * @return Response
     */
    public function setTagUuid(string $tagUuid): Response
    {
        $this->tagUuid = $tagUuid;
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
     * @return Response
     */
    public function setName(string $name): Response
    {
        $this->name = $name;
        return $this;
    }
}
