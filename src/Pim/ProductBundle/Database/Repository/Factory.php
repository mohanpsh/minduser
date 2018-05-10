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

namespace Pim\ProductBundle\Database\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class Factory
 * @package Pim\ProductBundle\Database\Repository
 */
class Factory
{
    /**
     * @var array
     */
    private $setter;

    /**
     * @var EntityManager
     */
    private $ormEm;

    /**
     * Factory constructor.
     * @param ObjectManager $ormEm
     */
    public function __construct(EntityManager $ormEm)
    {
        $this->ormEm = $ormEm;
    }

    /**
     * @return EntityRepository
     */
    public function product(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('PimProductBundle:Product');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function category(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('PimProductBundle:Category');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function tags(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('PimProductBundle:Tags');
        }

        return $this->setter[__FUNCTION__];
    }


    /**
     * @return EntityRepository
     */
    public function attributeSet(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('PimProductBundle:AttributeSet');
        }

        return $this->setter[__FUNCTION__];
    }
}
