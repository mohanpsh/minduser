<?php

/**
 * all code by me
 *
 * @copyright  Stefan Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2015
 *
 */

namespace Pim\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="pim_categories")
 * @ORM\Entity
 */
class Category
{

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uuid;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * */
    private $children;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children",cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="uuid", onDelete="CASCADE")
     * */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="canonical_url", type="string", length=255, nullable=true)
     */
    private $canonicalUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_title", type="string", length=255)
     */
    private $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="short_desc", type="text", nullable=true)
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="long_desc", type="text", nullable=true)
     */
    private $longDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=255, nullable=true)
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255)
     */
    private $active;

    /**
     * @var Product[]
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     */
    private $products;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getUuid(): \Ramsey\Uuid\Uuid
    {
        return $this->uuid;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $uuid
     * @return Category
     */
    public function setUuid(\Ramsey\Uuid\Uuid $uuid): Category
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     * @return Category
     */
    public function setChildren(ArrayCollection $children): Category
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return Category
     */
    public function getParent(): Category
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent): Category
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCanonicalUrl(): string
    {
        return $this->canonicalUrl;
    }

    /**
     * @param string $canonicalUrl
     * @return Category
     */
    public function setCanonicalUrl(string $canonicalUrl): Category
    {
        $this->canonicalUrl = $canonicalUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Category
     */
    public function setTitle(string $title): Category
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubTitle(): string
    {
        return $this->subTitle;
    }

    /**
     * @param string $subTitle
     * @return Category
     */
    public function setSubTitle(string $subTitle): Category
    {
        $this->subTitle = $subTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDesc(): string
    {
        return $this->shortDesc;
    }

    /**
     * @param string $shortDesc
     * @return Category
     */
    public function setShortDesc(string $shortDesc): Category
    {
        $this->shortDesc = $shortDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    /**
     * @param string $longDesc
     * @return Category
     */
    public function setLongDesc(string $longDesc): Category
    {
        $this->longDesc = $longDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoUrl(): string
    {
        return $this->seoUrl;
    }

    /**
     * @param string $seoUrl
     * @return Category
     */
    public function setSeoUrl(string $seoUrl): Category
    {
        $this->seoUrl = $seoUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->active;
    }

    /**
     * @param string $active
     * @return Category
     */
    public function setActive(string $active): Category
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     * @return Category
     */
    public function setProducts(array $products): Category
    {
        $this->products = $products;
        return $this;
    }
}
