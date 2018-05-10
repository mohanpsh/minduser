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

namespace AppBundle\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface PaginationInterface
 * @package AppBundle\Interfaces
 */
interface PaginationInterface
{

    /**
     * @return ArrayCollection
     */
    public function getSortableList();

    /**
     * @return integer
     */
    public function getCount();
}
