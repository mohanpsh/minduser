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

namespace Pim\ProductBundle\Database\Entity;

use Pim\ProductBundle\Entity\AttributeSet;
use Pim\ProductBundle\Entity\Product;
use Pim\ProductBundle\Entity\Category;
use Pim\ProductBundle\Entity\ProductAttributes;
use Pim\ProductBundle\Entity\Tags;

/**
 * Class Factory
 * @package AppBundle\Database\Repository
 */
class Factory
{
    /**
     * @return Product
     */
    public function product(): Product
    {
        return new Product();
    }

    /**
     * @return Product
     */
    public function productAttributes(): ProductAttributes
    {
        return new ProductAttributes();
    }

    /**
     * @return Category
     */
    public function category(): Category
    {
        return new Category();
    }

    /**
     * @return Tags
     */
    public function tags(): Tags
    {
        return new Tags();
    }

    /**
     * @return AttributeSet
     */
    public function attributeSet(): AttributeSet
    {
        return new AttributeSet();
    }
}
