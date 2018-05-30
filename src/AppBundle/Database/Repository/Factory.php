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

namespace AppBundle\Database\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class Factory
 * @package AppBundle\Database\Repository
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
    public function user(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('AppBundle:User');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function individual(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('AppBundle:Individual');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function center(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('AppBundle:BusinessCenter');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function privatespace(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('AppBundle:PrivateSpace');
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return EntityRepository
     */
    public function commonspace(): EntityRepository
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = $this->ormEm->getRepository('AppBundle:CommonSpace');
        }

        return $this->setter[__FUNCTION__];
    }
}
