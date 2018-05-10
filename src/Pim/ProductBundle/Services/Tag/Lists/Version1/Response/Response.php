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

use AppBundle\Interfaces\PaginationInterface;
use AppBundle\Rest\Api\Response\ResponseInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Pim\ProductBundle\Services\Common\ResponseTrait;

/**
 * Class Response
 * @Serializer\AccessorOrder("custom", custom={"code","status","message","date","scriptTimeSeconds","errors"})
 * @package Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Response
 */
class Response implements ResponseInterface, PaginationInterface
{
    use ResponseTrait;

    /**
     * @var integer
     * @Serializer\SerializedName("offset")
     * @Serializer\Type("integer")
     */
    private $offset;

    /**
     * @var integer
     * @Serializer\SerializedName("limit")
     * @Serializer\Type("integer")
     */
    private $limit;

    /**
     * @var integer
     * @Serializer\SerializedName("count")
     * @Serializer\Type("integer")
     */
    private $count;

    /**
     * @var string
     * @Serializer\SerializedName("orderBy")
     * @Serializer\Type("string")
     */
    private $orderBy;

    /**
     * @var string
     * @Serializer\SerializedName("orderDir")
     * @Serializer\Type("string")
     */
    private $orderDir;

    /**
     * @Serializer\SerializedName("tags")
     * @Serializer\Type("ArrayCollection<Pim\ProductBundle\Services\Tag\Lists\Version1\Response\Tag>")
     * @Serializer\XmlList(entry="tag")
     *
     * @var Tag[]|ArrayCollection
     */
    private $tags;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return Response
     */
    public function setOffset(int $offset): Response
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return Response
     */
    public function setLimit(int $limit): Response
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Response
     */
    public function setCount(int $count): Response
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     * @return Response
     */
    public function setOrderBy(string $orderBy): Response
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderDir(): string
    {
        return $this->orderDir;
    }

    /**
     * @param string $orderDir
     * @return Response
     */
    public function setOrderDir(string $orderDir): Response
    {
        $this->orderDir = $orderDir;
        return $this;
    }

    /**
     * @param Tag $tag
     * @return Response
     */
    public function addTag(Tag $tag): Response
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
        return $this;
    }

    /**
     * @return ArrayCollection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return ArrayCollection|Tag[]
     */
    public function getSortableList()
    {
        return $this->tags;
    }
}
