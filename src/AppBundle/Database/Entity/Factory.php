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

namespace AppBundle\Database\Entity;

use AppBundle\Entity\User;

/**
 * Class Factory
 * @package AppBundle\Database\Repository
 */
class Factory
{
    /**
     * @return User
     */
    public function user(): User
    {
        return new User();
    }
}
