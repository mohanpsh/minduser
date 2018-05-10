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

namespace Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Request
 */
class Request
{
    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $offset = 0;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $limit = 10;

    /**
     * @var string
     *
     * @Assert\Regex("(^name$|^created$|^updated$)")
     */
    private $orderBy;

    /**
     * @var string
     * @Assert\Regex("(^ASC$|^DESC$)")
     */
    private $orderDir;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return Request
     */
    public function setOffset(int $offset): Request
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
     * @return Request
     */
    public function setLimit($limit): Request
    {
        $this->limit = $limit;
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
     * @return Request
     */
    public function setOrderBy(string $orderBy): Request
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
     * @return Request
     */
    public function setOrderDir(string $orderDir): Request
    {
        $this->orderDir = $orderDir;
        return $this;
    }
}
